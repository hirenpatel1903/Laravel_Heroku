<?php

namespace App\Http\Controllers\admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use URL;
use App\Helpers\Helper;
use App\Models\Role;
use App\Http\Controllers\admin\BaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;


class UserController extends BaseController
{

    /* My profile Start*/
    public function myProfile(){
        try{
            $data = User::getUserDetails(Auth::user()->id);
            return view('admin.user.myprofile',compact('data'));
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('myprofile');
        }
    }

    public function updateMyProfile(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' =>'required|email|unique:users,email,'.Auth::user()->id,
                'profile_pic' => 'nullable|image|mimes:jpeg,bmp,png,jpg|max:15000'
            ]);

            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            User::updateMyProfile($request);

            session()->flash('success',  trans('messages.updatemyProfile'));
            return redirect()->route('myprofile');
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }
    }

    /* My profile End*/

    /* Change Password Start */
    public function chnagePassword(){
        $data = User::getUserDetails(Auth::user()->id);
        return view('admin.user.changepassword',compact('data'));
    }
    public function storeChangePassword(Request $request){
        try{
                //            $validator = Validator::make($request->all(), [
                //               'currentpassword' => 'required',
                //               'password' => ['required'],
                //               'password_confirmation' => ['same:password'],
                //            ]);
                //
                //            if($validator->fails()) {
                //                return back()->withInput()->withErrors($validator->errors());
                //            }


            $rules = array(
                'currentpassword' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:8',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character
                ],
                'password_confirmation' => ['same:password'],
            );

            $messsages = array(
                'password.regex' => trans('messages.strongPassword'),
            );
            $validator = Validator::make($request->all(), $rules,$messsages);
            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            if(!Hash::check($request->currentpassword, auth()->user()->password)){
                session()->flash('error', trans('messages.currentPasdswordNotmatch'));
                return redirect()->route('change-password');
            }

            $data = \App\Models\User::find(Auth::user()->id);
            $data->password = bcrypt($request->password);
            $data->save();

            session()->flash('success', trans('messages.passwordChanged'));
            return redirect()->route('change-password');

        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('change-password')->withInput();
        }
    }
    /* Change Password End*/


    /* Create User Start */
    public function create(Request $request){
        try{
            $roles = Role::getRoles();
            if(Auth::user()->role_id==config('const.roleAdmin')){
                unset($roles[0]);
            }
            return view('admin.user.create',compact('roles'));
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('user.create');
        }
    }
    public function store(Request $request){
        try{

            // $validator = Validator::make($request->all(), [
            //     'name' => 'required',
            //     'email' => 'unique:users,email',
            //     'password' => 'required',
            // ]);
            // if($validator->fails()) {
            //     return back()->withInput()->withErrors($validator->errors());
            // }

            $rules = array(
                'name' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:8',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character
                ],
                'email' => 'unique:users,email',
            );

            $messsages = array(
                'password.regex' => trans('messages.strongPassword'),
            );

            $validator = Validator::make($request->all(), $rules,$messsages);
            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            $data = User::addUser($request);
            session()->flash('success', trans('messages.userCreations'));
            return redirect()->route('user.index');
    }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('user.create');
        }
    }
    /* Create User End*/

    /* Edit Start*/
    public function edit($id){
        try{
            $roles = Role::getRoles();
            $userdata =  User::getUserDetails($id);
            $statusArray = Helper::getStatusArray();

            return view('admin.user.edit',array('statusArray'=>$statusArray,'roles'=>$roles,'data'=>$userdata));
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('user.edit',$id);
        }
    }

    public function update(Request $request,$id){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' =>'required|email|unique:users,email,'.$id,
            ]);

            if($validator->fails()) {
                return back()->withInput()->withErrors($validator->errors());
            }

            DB::beginTransaction();
                User::editUser($id,$request);
            DB::commit();

            session()->flash('success',  trans('messages.userUpdate'));
            return redirect()->route('user.index');
        }catch(\Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
            return back()->withInput();
        }
    }
    /* End End */


    /* User Listing Start */
    public function index(){
       $status = Helper::getStatusArray();
       $roles = Role::all();
       return view('admin.user.index',compact('status','roles'));
    }

    public static function postUsersList(Request $request){
        try{
           return User::postUsersList($request);
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('user.create');
        }
    }
    /* User Listing Start */

    /* Delete User */
    public function destroy($id){
        try{
            $userData = User::find($id);
            $data = User::where('id',$id)->delete();
            return Response::json($data);
        }catch(\Exception $e){
            return Response::json($e);
        }
    }

     /* Show User Details */
     public function show($id){
        try{
            $data = User::getUserDetails($id);
            $showResetPasswordBtn = true;
            if(Auth::user()->role_id==config('const.roleAdmin')){
                $showResetPasswordBtn = true;
            }else{
                $showResetPasswordBtn = false;
            }
            return view('admin.user.show',compact('showResetPasswordBtn','data'));
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('user.index');
        }

    }


    /* Reset Password Send Email */
    public function postResetUserPassword(Request $request){
        try{
            $data = User::sendResetPasswordEmail($request->id);
            return Response::json($data);
        }catch(\Exception $e){
            return Response::json($e);
        }
    }


    public function getUserSubscriptions(){
          return view('admin.user.usersubscription');
    }


}
