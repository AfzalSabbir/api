<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use App\Models\Admin;
use App\Models\EmailVerification;
use Carbon\Carbon;

class EmailVerificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
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
    public function emailVerification(Request $request, $token = null)
    {
        $token = decrypt($token);

        /*$email = session()->get('verifiable_email');
        if(is_null($email)) abort(419);*/

        if (request()->isMethod('POST')){
            $code = request()->emailCode;
            $emailVerification  = EmailVerification::where('token', $token)
                ->where('created_at', '>=', sub_hours(date('Y-m-d H:i:s'), 3))
                ->orderBy('id', 'desc')
                ->first();

            if(is_null($emailVerification)){
                session()->flash('verification_time_error', 1);
                return view('frontend.auth.email_verification', compact('token'));
            }

            if($emailVerification->code != $code){
                session()->flash('verification_code_error', 1);
                return view('frontend.auth.email_verification', compact('token'));
            }

            $userData   = Admin::where('email', $emailVerification->email)->first(['id', 'name', 'username', 'email', 'mobile', 'email_verified_at']);

            // dd($userData);

            if(!is_null($userData->email_verified_at)){
                session()->flash('already_verified', 1);
                return view('frontend.auth.email_verification', compact('token'));
            }

            $genToken   = md5($userData->username).md5($userData->email.$code);

            $now    = Carbon::now();
            // $time   = Carbon::parse('2020-07-06 04:42:00');
            $time   = Carbon::parse($emailVerification->created_at);

            $diff   = $time->diffInSeconds($now)/60/60;


            if($diff >= 3) {
                session()->flash('verification_time_error', 1);
                return view('frontend.auth.email_verification', compact('token'));
            }


            if($diff < 3 && $emailVerification->code == $code && $emailVerification->token == $genToken){
                $emailVerification->delete();
                EmailVerification::where('created_at', '<=', sub_hours(date('Y-m-d H:i:s'), 3))->delete();
                $userData->update(['email_verified_at' => date('Y-m-d H:i:s')]);
                session()->forget('verifiable_email');
                session()->flash('signup_success', 'Email Verification Success');
                return redirect()->route('login', ['signup' => 1, 'ref' => encrypt($userData->username)]);
            } else {
                session()->flash('verification_code_error', 1);
                return view('frontend.auth.email_verification', compact('token'));
            }
        }

        return view('frontend.auth.email_verification', compact('token'));
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
}