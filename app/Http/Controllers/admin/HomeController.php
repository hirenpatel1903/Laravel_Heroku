<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\BaseController;
use PDF;
use Auth;
use App\Models\User;
use App\Models\Book;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function notFound(Request $request){
        return view('admin.errors.404');
    }

    public function exceptions(Request $request){
        return view('admin.errors.500');
    }

    public function unauthorized(Request $request){
        return view('admin.errors.401');
    }

    /* Set Time Zone in Sesstion For date display USE Start*/
    public function settimezone(Request $request){
        $data = $request->all();
        session()->put('customTimeZone',$data['timezone']);
    }
    /* Set Time Zone in Sesstion For date display USE End*/

    public function index(){
        if(Auth::user()->role_id==config('const.roleAdmin')){
            $data_total = new \stdClass();
            $data_total->data_total_UserAccount = User::activeDepartmentAccountCount();
            $data_total->data_total_Books = Book::activeDepartmentAccountCount();

            return view('admin.dashboard.dashboard',compact('data_total'));
        }
        if(Auth::user()->role_id==config('const.roleUser')){
            $data_total = new \stdClass();
            $user_data_deptName = User::where('id',Auth::user()->id)->first();
            return view('employee.dashboard.dashboard',compact('dept_name_data','data_total'));
        }
    }
}
