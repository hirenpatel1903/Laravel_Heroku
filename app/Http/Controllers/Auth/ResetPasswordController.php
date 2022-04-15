<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Models\Password_Resets;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /* Forgot Password Email */
    public function resetPasswordSendEmail(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        $user = User::where('email',$request->email)->whereIn('role_id',[1,2,3])->first();
        if(!$user){
            session()->flash('error', trans('messages.notfoundEmail'));
            return redirect('login');
        }

        if(isset($user) && $user->email_verified_at==''){
            session()->flash('error', trans('messages.emailNotVerified'));
            return redirect('login');
        }

        if(isset($user) && $user->status==config('const.statusInActive')){
            session()->flash('error', trans('messages.accountInactive'));
            return redirect('login');
        }

        try{
            $token = Crypt::encryptString($request->email);
            Password_Resets::updateOrCreate(
            [
                'email' => $request->email
            ], [
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
            ])->forgotLink($token, $request->email,'',$user->fullName);

            session()->flash('success', trans('messages.forgotPassword'));
            return redirect('login');
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('myprofile');
        }
    }

    /* Reset Password Form */
    public function showPasswordResetForm($token,$isMobile=''){
        try{
            $tokenData = DB::table('password_resets')->where('token', $token)->first();
            if ( !$tokenData ){
                if(isset($isMobile) && $isMobile==1){
                    session()->flash('error', trans('messages.InvalidResetPassword'));
                     return redirect()->route('verification');
                }else{
                    session()->flash('error', trans('messages.InvalidResetPassword'));
                    return redirect()->to('/login');
                }
            }
            return view('auth.passwords.reset',array('token'=>$token,'isMobile'=>$isMobile));
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('resetpasswordform');
        }
    }


    /* Reset Password  */
    public function resetPassword(Request $request,$token,$isMobile='') {
         $rules = array(
            //'currentpassword' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            //'password_confirmation' => ['same:password'],
        );

        $messsages = array(
            'password.regex' => trans('messages.strongPassword'),
        );
        $validator = Validator::make($request->all(), $rules,$messsages);
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        try{
            $password = $request->password;
            $tokenData = DB::table('password_resets')->where('token', $token)->first();

            $user = User::where('email', $tokenData->email)->first();
            if ( !$user ) {
                session()->flash('error', trans('messages.InvalidResetPassword'));
                return redirect()->to('password/reset');
            }

            $user->password = Hash::make($password);
            $user->wrong_attempt_count = 0;
            $user->status = config('const.statusActive');
            $user->update();

            DB::table('password_resets')->where('email', $user->email)->delete();

            if(isset($isMobile) && $isMobile==1){
                session()->flash('success', trans('messages.passwordResetSuccess'));
                return redirect()->route('forgot-password');
            }else{
                session()->flash('success', trans('messages.passwordResetSuccess'));
                return redirect()->route('login');
            }
         }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('login');
        }
   }
}
