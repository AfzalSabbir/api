<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Models\Admin;

use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if (!Auth::guard('admin')->check()) {
            return view('frontend.auth.register');
        }
        return redirect()->back();
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name'              => 'required|min:4',
            "email"             => 'required|email|unique:admins',
            "username"          => 'required|min:4|unique:admins',
            "password"          => 'required|string|min:8',
        ]);

        echo 'Saving Your Data!';

        $data = $request->except(['_token', 'password', 'username']);
        $data['username'] = strtolower($request->username);
        $data_mail = $data;

        session()->put('verifiable_email', encrypt($request->email));


        $data['password'] = Hash::make($request->password);
        $data['admin_role'] = 2;
        $data['photo'] = 'public/images/default.png';

        Admin::create($data);

        session()->flash('signup_success', 'Signup Success');

        return redirect()->route('mail.emailVerification')->with($data_mail);
        return redirect()->route('login', ['signup' => 1, 'ref' => encrypt($request->username)]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 1,
        ]);
    }
}
