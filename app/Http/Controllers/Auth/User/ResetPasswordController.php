<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Validator;

use App\Models\ResetPassword;
use App\Models\Admin;

use DB;
use Session;

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
    protected $redirectTo = 'admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
        $this->expire_after = 3; // In hrs
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('frontend.auth.passwords.email')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }


    protected function setPassword(Request $request, $token){

        $isPost = request()->isMethod('POST');

        if(\Auth::guard('admin')->check()) abort('401');

        if($isPost){
            $request->validate([
                'password' => 'required|min:8|confirmed'
            ]);

            $data = DB::table('password_resets')
                ->leftjoin('admins', 'admins.id', '=', 'password_resets.admin_id')
                ->where('password_resets.token', $token)
                ->where('password_resets.deleted_at', NULL)
                ->where('password_resets.created_at', '>', \Carbon\Carbon::now()->subHours($this->expire_after)->toDateTimeString())
                ->orderBy('password_resets.id', 'desc')
                ->select(
                    'admins.name',
                    'admins.username',
                    'admins.password',

                    'password_resets.*'
                )
                ->first();
            if (!is_null($data)) {
                $old_password = $data->password;
                $password = \Hash::make($request->password);

                $pass_res = ResetPassword::where('token', $token)->orderBy('id', 'desc')->first();
                $pass_res->update(['old_password'=> $old_password]);
                $pass_res->delete();

                $push_pass = Admin::where('id', $pass_res->admin_id)->first();
                $push_pass = $push_pass->update(['password'=> $password]);

                Session::flash('message', '<strong>'.$data->name.'</strong>, your password reset successfully!'); 
                Session::flash('alert-class', 'alert-success');
                Session::flash('username', $data->username);
                return redirect()->route('login');
            }

        }
        else {
            $data = DB::table('password_resets')
                ->leftjoin('admins', 'admins.id', '=', 'password_resets.admin_id')
                ->where('password_resets.token', $token)
                ->where('password_resets.deleted_at', NULL)
                ->where('password_resets.created_at', '>', \Carbon\Carbon::now()->subHours($this->expire_after)->toDateTimeString())
                ->orderBy('password_resets.id', 'desc')
                ->select(
                    'admins.name',
                    'admins.username',

                    'password_resets.*'
                )
                ->first();
        }

        return view('frontend.auth.passwords.reset', compact('data'));
    }
}
