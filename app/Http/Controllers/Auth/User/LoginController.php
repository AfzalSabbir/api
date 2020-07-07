<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Helpers\QueryHelper;
use Jenssegers\Agent\Agent;

use App\Mail\MailSendSocialitePassword;

use App\Models\Menu;
use App\Models\Admin;

use Location;
use Auth;
use Hash;
use Str;
use Session;
use Socialite;
use Mail;


class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
  * Where to redirect users after login.
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
    // Auth::guard('admin')->logout();
    $this->middleware('guest:admin')->except('logout');
  }


  public function showLoginForm()
  {
    //Set Intended
    if (route('register') != url()->previous()) {
        session(['url.intended' => url()->previous()]);
    }

    //View Admin Login Form
    return view('frontend.auth.login');
  }


  public function login(Request $request)
  {
    //Validate the form data
    $this->validate($request, [
      'username'    => 'required',
      'password'    => 'required|min:6'
    ],[],[
      'username'=> __('backend/default.username'),
      'password'=> __('backend/default.password')
    ]);

    //Attempt to log the employee in
    if (Auth::guard('admin')->attempt(['username' => strtolower($request->username), 'password' => $request->password], $request->remember)) {

      $this->saveAccess();

      // $lang = json_decode(Menu::where('route', 'language')->first()->parameter)[0];
      $lang = Auth::guard('admin')->user()->language;

      Session::put('locale', $lang);

      //If successful then redirect to the intended location
      return 'Signin SuccessFully! Use "/api_logout" to logout <a href="'.asset('/api_logout').'">Logout</a>';
    }

    //If unsuccessfull, then redirect to the admin login with the data
    // Session::flash('login_error', "Invalid username / password");

    Session::flash('message', 'Invalid username / password'); 
    Session::flash('alert-class', 'alert-danger');

    return redirect()->back()->withInput($request->only('email', 'remember'));
  }

  public function logout()
  {
    Auth::guard('admin')->logout();
    return redirect()->route('login');
  }

  public function github()
  {
    return Socialite::driver('github')->redirect();
  }
  public function githubRedirect()
  {
    $data = Socialite::driver('github')->stateless()->user();
    $user = $data->user;

    $password = Str::random(8);

    $details = [
      'name'              => $user['name']?$user['name']:$user['login'],
      'username'          => 'github_'.($data->nickname?$data->nickname:$user['id']),
      'password'          => Hash::make($password),
      'photo'             => $data->avatar,
      'email_verified_at' => date('Y-m-d H:i:s'),
      // 'token'     => $data->token,
    ];

    $user = Admin::firstOrCreate(['email' => $user['email']], $details);

    $details['password'] = $password;

    if ($user->wasRecentlyCreated) {
      $to = $user['email'];
      Mail::to($to)->send(new MailSendSocialitePassword($details));
    }

    Auth::guard('admin')->login($user, true);

    return redirect()->route('home');
  }

  public function facebook()
  {
    return Socialite::driver('facebook')->redirect();
  }
  public function facebookRedirect()
  {
    $data = Socialite::driver('facebook')->stateless()->user();
    $user = $data->user;

    $password = Str::random(8);

    $details = [
      'name'              => $user['name'],
      'username'          => 'facebook_'.($data->nickname?$data->nickname:$user['id']),
      'password'          => Hash::make($password),
      'photo'             => $data->avatar,
      'email_verified_at' => date('Y-m-d H:i:s'),
      // 'token'     => $data->token,
    ];

    $user = Admin::firstOrCreate(['email' => $user['email']], $details);

    $details['password'] = $password;

    if ($user->wasRecentlyCreated) {
      $to = $user['email'];
      Mail::to($to)->send(new MailSendSocialitePassword($details));
    }

    Auth::guard('admin')->login($user, true);

    return redirect()->route('home');
  }

  public function google()
  {
    return Socialite::driver('google')->redirect();
  }
  public function googleRedirect()
  {
    $data = Socialite::driver('google')->stateless()->user();
    $user = $data->user;

    $password = Str::random(8);

    $details = [
      'name'              => $user['name'],
      'username'          => 'google_'.($data->nickname?$data->nickname:$user['id']),
      'password'          => Hash::make($password),
      'photo'             => $data->avatar,
      'email_verified_at' => date('Y-m-d H:i:s'),
      // 'token'     => $data->token,
    ];

    $user = Admin::firstOrCreate(['email' => $user['email']], $details);

    $details['password'] = $password;

    if ($user->wasRecentlyCreated) {
      $to = $user['email'];
      Mail::to($to)->send(new MailSendSocialitePassword($details));
    }

    Auth::guard('admin')->login($user, true);

    return redirect()->route('home');
  }

  private function saveAccess()
  {
    $agent = new Agent();

    if($agent->isDesktop()){
      $device = "PC";
    }
    else{
      $device = "Mobile";
    }

    $browser = $agent->browser();

    $data = array(
      'admin_id' => Auth::guard('admin')->user()->id,
      'ip' => \Request::ip(),
      // 'country' => Location::get()->countryCode,
      'browser' => $browser,
      'device' => $device
    );
    QueryHelper::loginInfo('AdminAccessInfo', $data);
  }


  public function username()
  {
    return 'username';
  }
}
