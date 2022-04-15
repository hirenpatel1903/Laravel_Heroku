<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use URL;
use App\Helpers\Helper;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getroleusers() {
        return $this->belongsTo('App\Models\Role','role_id');
    }

    public function getfullnameAttribute(){
        $firstName = ucfirst($this->name)   ;
        //$lastName= ucfirst($this->last_name);
        return "{$firstName}";
    }

    public static function activeDepartmentAccountCount(){
        $query = User::where('role_id',2);
        return $query->count();
    }

    public static function getUserDetails($id){
        $data = User::find($id);
        if($data){
            if(isset($data->profile_pic) && $data->profile_pic!=''){
                $data->profile_pic = Helper::displayProfilePath().''.$data->profile_pic;
            }else{
                $data->profile_pic = URL::to('/').'/assets/media/users/default.jpg';
            }
        }
        return $data;
    }

    public static function updateMyProfile($request){
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $profilelogoName = $data->profile_pic;
        if(isset($request->profile_pic) && $request->profile_pic !=''){

            /* Unlink Image */
            if(isset($data->profile_pic) && $data->profile_pic!=''){
                $imagePath = Helper::profileFileUploadPath().''.$data->profile_pic;
                if(file_exists($imagePath)){
                    unlink($imagePath);
                }
            }

            $profilelogo   = $request->profile_pic;
            $profilelogoName = 'Profile-'.time().'.'.$request->profile_pic->getClientOriginalExtension();
            $profilelogo->move(Helper::profileFileUploadPath(), $profilelogoName);
        }
        $data->profile_pic = $profilelogoName;
        $data->save();
        return self::getUserDetails($data->id);
    }

    /* Admin User List Start */
    public static function postUsersList($request){
        $query = User::select('users.*','role.name as role_name')->leftJoin('role', 'role.id', '=', 'users.role_id');
        if($request->order ==null){
            $query->orderBy('users.id','desc');
        }

        $searcharray = array();
    	parse_str($request->fromValues,$searcharray);

        if(isset($searcharray) && !empty($searcharray)){
            if($searcharray['status'] !=''){
                    $query->where("users.status",'=',$searcharray['status']);
            }
            if($searcharray['role_id'] !=''){
                    $query->where("users.role_id",'=',$searcharray['role_id']);
            }
        }
        return Datatables::of($query)
            ->addColumn('status', function ($data) {
               return Helper::Status($data);
            })
            ->addColumn('action', function ($data) {
               $recoverylink = '';
               if(Auth::user()->role_id == config('const.roleAdmin')){
                   $editLink = URL::to('/').'/admin/user/'.$data->id.'/edit';
                   $deleteLink = $data->id;
               }else{
                   $editLink = '';
                   $deleteLink = '';
                   $recoverylink = '';
               }
               $viewLink = URL::to('/').'/admin/user/'.$data->id;

               return Helper::Action($editLink,$deleteLink,$viewLink,$recoverylink);
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }

    /* Send Reset password Email */
    public static function sendResetPasswordEmail($id){
        $password = Helper::generateRandomString(5).'@Y20';
        $data = User::find($id);
        $data->password = Hash::make($password);
        $data->wrong_attempt_count = 0;
        $data->save();
            dispatch(new SendEmailJob([
                '_blade'=>'resetpasswordofuser',
                'subject'=>trans('email.resetpasswordofuser'),
                'email'=>$data->email,
                'name'=>  ucfirst($data->name),
                'url'=> URL::to('/').'/login',
                'password'=> $password,
            ]));

        return $data;
    }


    /* Create new user Email */
    public function sendCreationEmailToAnyAdminUsers($password){
        dispatch(new SendEmailJob([
            '_blade'=>'adminusercreation',
            'subject'=>trans('email.adminusercreation'),
            'email'=>$this->email,
            'name'=>  ucfirst($this->name),
            'url'=> URL::to('/').'/login',
            'password'=> $password,
        ]));
    }

    public static function addUser($request){
        $data = new User();
        $data->name = $request->name;
        $data->role_id = $request->role_id;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->email_verified_at = Carbon::now();
        $data->status = config('const.statusActive');
        $data->save();
        $data->sendCreationEmailToAnyAdminUsers($request->password);
        return $data;
    }

    /* Admin Update User Start */
    public static function editUser($id,$request){

        $data = User::find($id);
        $data->name = $request->name;
        $data->role_id = $request->role_id;
        $data->email = $request->email;
        $data->status = $request->status;
        $data->save();

    }
    /* Admin Update User End*/
}
