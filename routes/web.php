<?php

/******************************************
 * Guest Api Routes
 ******************************************/

Route::post('api/register', 'Frontend\AxiosController@register')->name('api.register');
Route::get('api_logout', 'Frontend\HomeController@api_logout')->name('api_logout');

/**
 * Session Status
**/
Route::group(['prefix' => '/sessionStatus'], function() {
	Route::get('/guards', 'Frontend\AxiosController@guards');
});

/**
 * Other
**/
Route::get('/', function(){
    // return 'Signin SuccessFully! Use "/api_logout" to logout <a href="'.asset('/api_logout').'">Logout</a>';
    if(Auth::guard('admin')->check()) return view('frontend.auth.logout');
    else return redirect()->route('register');
})->name('home');



/**
 * ****************************
 * AXIOS Routes
 * ****************************
**/
Route::group(['prefix' => 'axios'], function(){
	// Route::get('/district/{district_id?}', 'Frontend\AuthAxiosController@upazila')->name('axios.upazila');
	Route::post('/validate', 'Frontend\AxiosController@registration_validate')->name('axios.validate');
	Route::post('/check-reset-code', 'Frontend\AxiosController@checkResetCode')->name('axios.checkResetCode');
});



/**
 * Auth Routes
**/
Auth::routes();
Route::any('captcha-test', function() {
    if (request()->getMethod() == 'POST') {
        $rules = ['captcha' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);
        if ($validator->fails()) {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        } else {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }

    $form = '<form method="post" action="captcha-test">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});


Route::get('/login', 'Auth\User\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\User\LoginController@login')->name('login.submit');

Route::post('/logout', 'Auth\User\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\User\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\User\RegisterController@registration')->name('register.submit');



Route::get('language/{locale}', 'Frontend\LanguageController@index')->name('language');
