<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\SendMail;
use App\Mail\MailEmailVerification;
use App\Mail\MailPasswordReset;
use App\Mail\MailGetUsername;

use App\Models\Admin;
use App\Models\ResetPassword;
use App\Models\EmailVerification;
use App\Models\MobileVerification;

use Session;
use Auth;
use Mail;

class MailSendController extends Controller
{
    public function mailsend()
    {
        $details = [
            'title' => 'Title: Mail from BoiNaw',
            'body' => 'Body: This is for testing email using smtp'
        ];

        $to = 'afzalbd1@gmail.com';

        Mail::to($to)->send(new SendMail($details));
        return view('frontend.emails.thanks');
    }


    public function passwordReset(Request $request)
    {
        try{
            $userData = Admin::where([
                    'username'=> strtolower($request->username),
                    'status'=> 1
                ])
                ->select(['id', 'email', 'name', 'mobile'])
                ->first();

            if (is_null($userData)) return 0;

            $code = substr(rand(100000, 999999) + rand(1000, 9999) - 99999, 0, 6);
            $token = md5($request->username).md5($userData->email.$code);

            $passwordReset = [
                'admin_id'=> $userData->id,
                'token'=> $token,
                'email'=> $userData->email,
                'code'=> $code

            ];

            ResetPassword::where('email', $userData->email)->delete();
            ResetPassword::create($passwordReset);

            $details = [
                'userData'=> $userData->toArray(),
                'code'=> $code,
                'token'=> $token,
                'time'=> date('d-M-Y h:i:sa')
            ];

            $to = $userData->email;

            Mail::to($to)->send(new MailPasswordReset($details));

            return 1;
        }
        catch (ValidationException $exception) {
          return response()->json([
            'status'    => 'error',
            'message'   => 'Error',
            'errors'    => $exception->errors(),
          ], 422);
        }
    }


    public function recoverUsername(Request $request)
    {
        $this->validate($request, [
            'recoverEmail'=> 'required|email'
        ],[],[
            'recoverEmail'=> __('backend/default.email')
        ]);
        $email = $request->recoverEmail;
        $admin = Admin::where('email', $email)->first(['email', 'name', 'username']);

        if ($admin) {
            Session::flash('alert-class', 'alert-info');

            $message = [
                'success'=> 'We\'ve sent your username to your email, please check your email.'
            ];

            $details = $admin->toArray();
            $details['time'] = date('d-M-Y h:i:sa');

            $to = $admin->email;
            Mail::to($to)->send(new MailGetUsername($details));
        } else {
            $message = [
                'msg'=> 'We couldn\'t find any record for the email <strong>'.$email.'</strong>'
            ];
        }

        return redirect()->back()->withErrors($message);
    }


    public function emailVerification(Request $request)
    {
        /*$this->validate($request, [
            'verificationEmail'=> 'required|email'
        ],[],[
            'verificationEmail'=> __('backend/default.email')
        ]);*/
        $email = request()->isMethod('POST') ? $request->email:session()->get('email');
        $userData = Admin::where('email', $email)->first(['id', 'email', 'name', 'username', 'mobile', 'created_at']);

        $msg = ['user_not_found' => '1'];
        if (is_null($userData)) return redirect()->back()->with($msg);

        $code = substr(rand(100000, 999999) + rand(1000, 9999) - 99999, 0, 6);
        $token = md5($userData->username).md5($userData->email.$code);

        $emailVerification = [
            'admin_id'=> $userData->id,
            'token'=> $token,
            'email'=> $userData->email,
            'code'=> $code

        ];

        EmailVerification::where('created_at', '<=', sub_hours(date('Y-m-d H:i:s'), 3))->delete();
        EmailVerification::where('email', $userData->email)->delete();
        EmailVerification::create($emailVerification);

        $details = [
            'userData'  => $userData->toArray(),
            'code'      => $code,
            'name'      => $userData->name,
            'token'     => $token,
            'time'      => date('d-M-Y h:i:sa', strtotime($userData->created_at))
        ];

        $to = $userData->email;
        Mail::to($to)->send(new MailEmailVerification($details));

        return redirect()->route('emailVerification', encrypt($token))->with(['email' => $email]);
    }
}