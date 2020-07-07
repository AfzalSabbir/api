<?php

/******************************************
 * Guest Api Routes
 ******************************************/
Route::group(['prefix' => '/my-api/guest'], function() {
  Route::post('/test', 'Frontend\ApiCrosController@test');
  Route::match(['GET', 'POST'], '/getVisitor', 'Frontend\ApiCrosController@getVisitor');
  Route::post('/subscribe', 'Frontend\ApiCrosController@subscribe');
});


Route::get('login/github', 'Auth\User\LoginController@github')->name('socialite.github');
Route::get('login/github/redirect', 'Auth\User\LoginController@githubRedirect')->name('socialite.githubRedirect');

Route::get('login/facebook', 'Auth\User\LoginController@facebook')->name('socialite.facebook');
Route::get('login/facebook/redirect', 'Auth\User\LoginController@facebookRedirect')->name('socialite.facebookRedirect');

Route::get('login/google', 'Auth\User\LoginController@google')->name('socialite.google');
Route::get('login/google/redirect', 'Auth\User\LoginController@googleRedirect')->name('socialite.googleRedirect');

Route::post('api/register', 'Frontend\AxiosController@register')->name('api.register');
Route::get('api_logout', 'Frontend\HomeController@api_logout')->name('api_logout');

/**
 * Session Status
**/
Route::group(['prefix' => '/sessionStatus'], function() {
	Route::get('/guards', 'Frontend\AxiosController@guards');
});

Route::get('/sitemap.xml', 'Frontend\SitemapController@index')->name('sitemap.root');
Route::get('/sitemap1.xml', 'Frontend\SitemapController@all');
Route::get('/sitemap2.xml', 'Frontend\SitemapController@book_view');



/**
 * Redirect after auth of user
**/
/**
 * Admin authentication routes
**/


/**
 * Other
**/
Route::get('/', 'Frontend\HomeController@home')->name('home');
Route::get('/home', 'Frontend\HomeController@home');
Route::get('/about', 'Frontend\HomeController@about')->name('about');

Route::get('/privacy-policy', 'Frontend\HomeController@privacy')->name('privacy');
Route::get('/terms-and-conditions', 'Frontend\HomeController@terms')->name('terms');
Route::get('/cookies-policy', 'Frontend\HomeController@cookies')->name('cookies');
Route::get('/contact-us', 'Frontend\HomeController@contact_us')->name('contact_us');

Route::get('/{location}/view', 'Frontend\BookController@location_browse')->name('book.location');
// Route::get('/district/{district_name}', 'Frontend\BookController@district_2_upazila')->name('book.district.district_name');
Route::get('/check-if-user-has-mobile', 'Frontend\AuthAxiosController@check_if_user_has_mobile')->name('check_if_user_has_mobile');


/****************************
 * Library
 ***************************/
Route::group(['prefix' => 'library'], function(){
	Route::get('/', 'Frontend\LibraryController@index')->name('library');
});



/**
 * **************************
 * Mail
 * **************************
**/
Route::group(['prefix' => 'mail'], function(){
	// Route::get('/send-mail','Frontend\MailSendController@mailsend');
	Route::match(['GET', 'POST'], '/email-verification', 'Frontend\MailSendController@emailVerification')->name('mail.emailVerification');
	Route::post('/password-reset', 'Frontend\MailSendController@passwordReset')->name('mail.passwordReset');
	Route::post('/check-mail-and-find-username', 'Frontend\MailSendController@recoverUsername')->name('mail.recoverUsername');
});



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
 * Search
**/
Route::group(['prefix' => 'search'], function(){
	Route::get('/', 'Frontend\SearchController@index')->name('search.book');
	Route::get('/axios', 'Frontend\AxiosController@book_search')->name('axios.search.book');
	Route::get('/axios/body', 'Frontend\AxiosController@body_search')->name('axios.search.body');
});



/**
 * Notification
**/
Route::group(['prefix' => 'notification'], function(){
	Route::get('/', 'Frontend\NotificationController@history')->name('notification.history');
	Route::post('/delete', 'Frontend\AuthAxiosController@delete_this_notification')->name('notification.axios.delete_this');
	Route::get('/history/axios', 'Frontend\AuthAxiosController@history')->name('notification.axios.history');
	Route::get('/real-all/axios', 'Frontend\AuthAxiosController@read_all_notification')->name('notification.axios.read_all');
	Route::get('/short/axios', 'Frontend\AuthAxiosController@short_notification')->name('notification.axios.short_notification');
	Route::get('/real-this-notification/axios/{base64_notification_id?}/{base64_notification_status?}', 'Frontend\AuthAxiosController@read_this_notification')->name('notification.axios.read_this_notification');
	Route::post('/search/axios', 'Frontend\AuthAxiosController@notification_search')->name('notification.axios.search');
});


/**
 * Message
**/
Route::group(['prefix' => 'message'], function(){
	Route::get('/', 'Frontend\MessageController@inbox')->name('message.inbox');
	Route::post('/delete', 'Frontend\AuthAxiosController@delete_this_message')->name('message.axios.delete_this');
	Route::get('/inbox/axios', 'Frontend\AuthAxiosController@inbox')->name('message.axios.inbox');
	Route::get('/real-all/axios', 'Frontend\AuthAxiosController@read_all_message')->name('message.axios.read_all');
	Route::get('/real-this-message/axios/{base64_message_id?}/{base64_message_status?}', 'Frontend\AuthAxiosController@read_this_message')->name('message.axios.read_this_message');
	Route::get('/short/axios', 'Frontend\AuthAxiosController@short_inbox')->name('message.axios.short_inbox');
	Route::post('/search/axios', 'Frontend\AuthAxiosController@message_search')->name('message.axios.search');
});



/**
 * Book
**/
Route::group(['prefix' => 'book'], function(){
	// Route::get('/add', 'Frontend\BookController@add')->name('book.add');
	Route::post('/add', 'Frontend\BookController@store')->name('book.store');
	Route::get('/browse', 'Frontend\BookController@index')->name('book.browse');
	Route::get('/browse/free', 'Frontend\BookController@free')->name('book.browse.free');
	Route::get('/view/{slug}', 'Frontend\BookController@view')->name('book.view.slug');
	Route::get('/grade/{grade}/browse', 'Frontend\BookController@grade_browse')->name('book.grade.browse');
	Route::get('/{location}/{slug}', 'Frontend\BookController@location_browse')->name('book.location.slug');
	Route::get('/district/{district_name}/browse', 'Frontend\BookController@district_book')->name('book.district.district_name.browse');
	Route::get('/upazila/{upazila_name}/browse', 'Frontend\BookController@upazila_book')->name('book.upazila.upazila_name.browse');

	Route::get('/wish-list', 'Frontend\BookController@wish_list')->name('book.wish_list');
	Route::post('/wish-list', 'Frontend\AuthAxiosController@store_wish')->name('book.axios.store_wish');
});



/**
 * Auth Routes
**/
Auth::routes();



Route::get('/login', 'Auth\User\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\User\LoginController@login')->name('login.submit');

Route::post('/logout', 'Auth\User\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\User\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\User\RegisterController@registration')->name('register.submit');


Route::get('/send-password-reset-code', 'Auth\User\ResetPasswordController@showResetForm')->name('user.showResetForm');
Route::get('/recover-username', 'Auth\User\RecoverUsernameController@showRecoverForm')->name('user.showRecoverForm');

Route::match(['get', 'post'], '/set-password/{token}', 'Auth\User\ResetPasswordController@setPassword')->name('user.setPassword');

Route::match(['get', 'post'], '/email-verification/{token}', 'Auth\User\EmailVerificationController@emailVerification')->name('emailVerification');


/**
 * **********************
 * Auth-AXIOS
 * **********************
**/
Route::group(['prefix' => 'auth-axios'], function(){
	Route::post('/institutions', 'Frontend\AuthAxiosTwoController@institutions')->name('auth.axios.institutions');
	Route::post('/districts', 'Frontend\AuthAxiosTwoController@districts')->name('auth.axios.districts');
	Route::post('/upazilas', 'Frontend\AuthAxiosTwoController@upazilas')->name('auth.axios.upazilas');
	Route::post('/unions', 'Frontend\AuthAxiosTwoController@unions')->name('auth.axios.unions');

	Route::get('/district/{district_id?}', 'Frontend\AuthAxiosController@upazila')->name('axios.upazila');
	Route::get('/confirm-bell-book/{base64_id?}/{base64_admin_id?}', 'Frontend\AuthAxiosController@confirm_bell_book')->name('auth.axios.confirm_bell_book');
	Route::post('/profile', 'Frontend\AuthAxiosController@get_profile')->name('axios.get_profile');
	Route::post('/profile/upload-image', 'Frontend\AuthAxiosController@upload_profile_image')->name('axios.upload_profile_image');

	Route::post('/profile/validate', 'Frontend\AuthAxiosController@profile_validate')->name('auth.axios.validate');
	Route::post('/profile/update', 'Frontend\AuthAxiosController@profile_update')->name('auth.axios.update');
	Route::post('/personal/profile/update', 'Frontend\AuthAxiosController@personal_profile_update')->name('auth.axios.personal.update');
	Route::post('/profile/photo/update', 'Frontend\AuthAxiosController@profile_photo_update')->name('auth.axios.photo.update');
	Route::post('/profile/password-change', 'Frontend\AuthAxiosController@profile_password_change')->name('auth.axios.password_change');

});



/**
 * Profile
**/
Route::group(['prefix' => 'profile'], function(){
	Route::get('/', 'Frontend\UserController@profile')->name('profile');
	Route::get('/setting', 'Frontend\UserController@profile_setting')->name('profile.setting');

	Route::get('/my-wish-list', 'Frontend\UserController@my_wish_list')->name('profile.my_wish_list');
	Route::get('/my-books', 'Frontend\UserController@my_books')->name('profile.my_books');
	Route::get('/add-book', 'Frontend\UserController@add_book')->name('profile.add_book');
	Route::post('/add-book', 'Frontend\UserController@store_book')->name('profile.store_book');
	Route::get('/edit-book/{slug}', 'Frontend\UserController@edit_book')->name('profile.edit_book');
	Route::post('/edit-book/{slug}', 'Frontend\UserController@update_book')->name('profile.update_book');
	Route::get('/bell/{slug}', 'Frontend\UserController@bell_list')->name('profile.book.bell_list');

	Route::post('/store-book', 'Frontend\BookController@store')->name('profile.book.store');
	Route::post('/update-book', 'Frontend\BookController@update')->name('profile.book.update');

	Route::get('/delete-book/{base64_id?}', 'Frontend\AuthAxiosController@delete_book')->name('profile.book.delete');
	Route::get('/report-book/{base64_id?}', 'Frontend\AuthAxiosController@report_book')->name('profile.book.report');
	Route::get('/bell-book/{base64_id?}', 'Frontend\AuthAxiosController@bell_book')->name('profile.book.bell');


});


/**
 * Account
**/
Route::group(['prefix' => 'account'], function(){
	Route::get('/setting', 'Frontend\UserController@account_setting')->name('account.setting');
});



/**
 * Admin Section Routes
**/
Route::group(['prefix' => 'arsssn-boinaw-admin'], function(){


	/**
	 * Admin authentication routes
	**/
	Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
	Route::post('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');
	Route::post('password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('password/reset','Auth\Admin\ResetPasswordController@reset');
	Route::get('password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::get('/change-password', 'Backend\HomeController@chnagePasswordForm')->name('admin.password.form');
	Route::post('/change-password', 'Backend\HomeController@chnagePassword')->name('admin.password.change');


	/**
	 * ENV
	*/
	Route::group(['prefix' => 'env'], function(){
		Route::get('/{token}', 'Backend\ENVController@index')->name('admin.env.read');
		Route::post('/save/{token}', 'Backend\ENVController@save')->name('admin.env.save');
	});
	

	/**
	 * Admin Dashboard
	*/
	Route::get('/', 'Backend\HomeController@index')->name('admin.home');
	Route::get('/home', 'Backend\HomeController@home');
	// Route::get('/dashboard', 'Backend\HomeController@index')->name('admin.home');
	// Route::get('/chart', 'Backend\HomeController@chart')->name('admin.chart');
	// Route::get('/form', 'Backend\HomeController@form')->name('admin.form');
	// Route::get('/table', 'Backend\HomeController@table')->name('admin.table');
	
	
	/**
	 * Admin routes
	*/
	Route::group(['prefix' => 'all-admin'], function(){
		Route::get('/', 'Backend\AdminController@index')->name('admin.all_admin.index');
		Route::get('/add', 'Backend\AdminController@create')->name('admin.all_admin.add');
		Route::post('/add', 'Backend\AdminController@store')->name('admin.all_admin.store');
		Route::get('/edit/{id}', 'Backend\AdminController@edit')->name('admin.all_admin.edit');
		Route::post('/edit/{slug}', 'Backend\AdminController@update')->name('admin.all_admin.update');
		Route::get('/delete/{slug}', 'Backend\AdminController@delete')->name('admin.all_admin.delete');
	});


	/**
	 * Setting routes
	*/
	Route::group(['prefix' => 'setting'], function(){
		Route::get('/', 'Backend\SettingController@index')->name('admin.setting.index');
		Route::get('/color-scheme/{color_scheme_id}', 'Backend\SettingController@color_scheme')->name('admin.setting.color_scheme');
		Route::get('/custom-scroll/{_1_0}', 'Backend\SettingController@custom_scroll')->name('admin.setting.custom_scroll');
		Route::get('/show-user-data/{_1_0}', 'Backend\SettingController@show_user_data')->name('admin.setting.show_user_data');
		Route::get('/show-background-image/{_1_0}', 'Backend\SettingController@show_background_image')->name('admin.setting.show_background_image');
		Route::get('/apply-scheme-on-card/{_1_0}', 'Backend\SettingController@apply_scheme_on_card')->name('admin.setting.apply_scheme_on_card');
		Route::get('/show-dev-menu/{_1_0}', 'Backend\SettingController@show_dev_menu')->name('admin.setting.show_dev_menu');
		Route::post('/', 'Backend\SettingController@store')->name('admin.setting.store');
	});


	/**
	 * Menu routes
	*/
	Route::group(['prefix' => 'menu'], function(){
		Route::get('/', 'Backend\MenuController@index')->name('admin.menu.index');
		Route::get('/add', 'Backend\MenuController@create')->name('admin.menu.create');
		Route::post('/add', 'Backend\MenuController@store')->name('admin.menu.store');
		Route::get('/edit/{id}', 'Backend\MenuController@edit')->name('admin.menu.edit');
		Route::post('/edit/{id}', 'Backend\MenuController@update')->name('admin.menu.update');
		Route::get('/delete/{id}', 'Backend\MenuController@delete')->name('admin.menu.delete');
		
		Route::get('/sort', 'Backend\MenuController@sort')->name('admin.menu.sort');
		Route::post('/sort', 'Backend\MenuController@sort_update')->name('admin.menu.sort_update');
	});


	/**
	 * Role routes
	*/
	Route::group(['prefix' => 'role'], function(){
		Route::get('/', 'Backend\RoleController@index')->name('admin.role.index');

		Route::group(['prefix' => 'assign'], function(){
			Route::get('/super-admin', 'Backend\RoleController@create')->name('admin.role.assign.super_admin');
			Route::get('/admin', 'Backend\RoleController@create')->name('admin.role.assign.admin');

			Route::group(['prefix' => 'user'], function(){
				Route::get('/', 'Backend\RoleController@create')->name('admin.role.assign_user');
				Route::get('/{admin_id?}', 'Backend\RoleController@userCreate')->name('admin.role.assign.user');
			});
			Route::post('/', 'Backend\RoleController@store')->name('admin.role.store');
		});
	});


	/**
	 * Admin Access Information
	*/
	Route::get('/log', 'Backend\AdminAccessInfoController@index')->name('admin.log.index');
	
    /**	
    * Category	
    **/	
    /*Route::group(['prefix' => 'category'], function(){	
        Route::get('/', 'Backend\CategoryController@index')->name('admin.category.index');	
        Route::post('/add', 'Backend\CategoryController@store')->name('admin.category.store');	
        Route::post('/edit/{encrypted_id}', 'Backend\CategoryController@update')->name('admin.category.update');	
        Route::get('/delete/{encrypted_id}', 'Backend\CategoryController@delete')->name('admin.category.delete');	
    });*/	
	
	/**
     * Database Backup routes
    */
	Route::group(['prefix' => 'backup'], function(){
		Route::get('/', 'Backend\BackupController@index')->name('admin.backup.index');
		Route::get('/new', 'Backend\BackupController@newBackup')->name('admin.backup.new');
		Route::post('/restore', 'Backend\BackupController@restoreBackup')->name('admin.backup.restore');
		Route::get('/delete/{file}', 'Backend\BackupController@deleteBakup')->name('admin.backup.delete');
	});


	/**
    * SMS Routes
    **/
    Route::group(['prefix' => 'sms'], function(){
        Route::get('/send', 'Backend\SMSController@sendSMS')->name('admin.sms.send');
        Route::post('/send', 'Backend\SMSController@sendSMS')->name('admin.sms.get_user');
        Route::post('/submit-send-sms', 'Backend\SMSController@submitSendSMS')->name('admin.sms.submit_send_sms');
        Route::get('/custom', 'Backend\SMSController@customSMS')->name('admin.sms.custom');
        Route::post('/custom', 'Backend\SMSController@customSMS')->name('admin.sms.submit_custom_sms');
        Route::get('/report', 'Backend\SMSController@smsReport')->name('admin.sms.report');
    });


    /**
     * Language
    **/
	Route::group(['prefix' => 'language'], function(){
	    Route::get('/', 'Backend\LanguageController@language')->name('admin.language.index');
	    Route::post('/insert', 'Backend\LanguageController@insert')->name('admin.language.insert');
	    Route::post('/create', 'Backend\LanguageController@create')->name('admin.language.create');
	});


    /**
     * Root
    **/
	Route::group(['prefix' => 'root'], function(){
	    Route::get('/', 'Backend\RootController@index')->name('admin.root.index');
	    Route::post('/create', 'Backend\RootController@create')->name('admin.root.create');
	    Route::get('/controllerSetup', 'Backend\RootController@controller_setup')->name('admin.root.controller_setup');
	});


    /**
	* Database
	**/
	Route::group(['prefix' => 'database'], function(){
		Route::get('/insert', 'Backend\DatabaseController@insert')->name('admin.database.insert');
		Route::post('/insert', 'Backend\DatabaseController@insert')->name('admin.database.insert');
		Route::post('/getFileText', 'Backend\DatabaseController@getFileText')->name('admin.database.get_file_text');
	});


    /**
	* Message
	**/
	Route::group(['prefix' => 'message'], function(){
		Route::get('/', 'Backend\MessageController@index')->name('admin.message.index');
		Route::post('/add', 'Backend\MessageController@store')->name('admin.message.store');
		Route::post('/send', 'Backend\MessageController@send')->name('admin.message.send');
		Route::post('/edit/{id}', 'Backend\MessageController@update')->name('admin.message.update');
		Route::get('/view/{id}', 'Backend\MessageController@index')->name('admin.message.view');
		Route::get('/delete/{id}', 'Backend\MessageController@delete')->name('admin.message.delete');
	});
    
    /**	
    * Module	
    **/	
    Route::group(['prefix' => 'module'], function(){	
        Route::get('/', 'Backend\ModuleController@index')->name('admin.module.index');	
        Route::get('/add', 'Backend\ModuleController@add')->name('admin.module.add');	
        Route::post('/add', 'Backend\ModuleController@store')->name('admin.module.store');	
        Route::get('/edit/{id}', 'Backend\ModuleController@edit')->name('admin.module.edit');	
        Route::post('/edit/{id}', 'Backend\ModuleController@update')->name('admin.module.update');	
        Route::get('/delete/{id}', 'Backend\ModuleController@delete')->name('admin.module.delete');	
        
        Route::post('/get_description', 'Backend\ModuleController@get_description')->name('admin.module.get_description');	
        Route::post('/get_tegs', 'Backend\ModuleController@get_tegs')->name('admin.module.get_tegs');	
    });

    /**	
    * ExamplePagination	
    **/	
    Route::group(['prefix' => 'example_pagination'], function(){	
        Route::get('/', 'Backend\ExamplePaginationController@index')->name('admin.example_pagination.index');	
        Route::get('/add', 'Backend\ExamplePaginationController@add')->name('admin.example_pagination.add');	
        Route::post('/add', 'Backend\ExamplePaginationController@store')->name('admin.example_pagination.store');	
        Route::get('/view/{encrypted_id}', 'Backend\ExamplePaginationController@view')->name('admin.example_pagination.view');	
        Route::get('/edit/{encrypted_id}', 'Backend\ExamplePaginationController@edit')->name('admin.example_pagination.edit');	
        Route::post('/edit/{encrypted_id}', 'Backend\ExamplePaginationController@update')->name('admin.example_pagination.update');	
        Route::get('/delete/{encrypted_id}', 'Backend\ExamplePaginationController@delete')->name('admin.example_pagination.delete');	
    });	
	
    /**	
    * Example	
    **/	
    Route::group(['prefix' => 'example'], function(){	
        Route::get('/', 'Backend\ExampleController@index')->name('admin.example.index');	
        Route::get('/add', 'Backend\ExampleController@add')->name('admin.example.add');	
        Route::post('/add', 'Backend\ExampleController@store')->name('admin.example.store');	
        Route::get('/view/{encrypted_id}', 'Backend\ExampleController@view')->name('admin.example.view');	
        Route::get('/edit/{encrypted_id}', 'Backend\ExampleController@edit')->name('admin.example.edit');	
        Route::post('/edit/{encrypted_id}', 'Backend\ExampleController@update')->name('admin.example.update');	
        Route::get('/delete/{encrypted_id}', 'Backend\ExampleController@delete')->name('admin.example.delete');	
    });	
	
    /**	
    * ExampleModal	
    **/	
    Route::group(['prefix' => 'example_modal'], function(){	
        Route::get('/', 'Backend\ExampleModalController@index')->name('admin.example_modal.index');	
        Route::post('/add', 'Backend\ExampleModalController@store')->name('admin.example_modal.store');	
        Route::post('/edit/{encrypted_id}', 'Backend\ExampleModalController@update')->name('admin.example_modal.update');	
        Route::get('/delete/{encrypted_id}', 'Backend\ExampleModalController@delete')->name('admin.example_modal.delete');	
    });
	
    
	/**
	* Book
	**/
	Route::group(['prefix' => 'book'], function(){
		Route::get('/', 'Backend\BookController@index')->name('admin.book.index');
		Route::post('/', 'Backend\BookController@index')->name('admin.book.index_search');
		Route::get('/all_books', 'Backend\BookController@index_image_view')->name('admin.book.index_image_view');
		Route::get('/add', 'Backend\BookController@add')->name('admin.book.add');
		Route::post('/add', 'Backend\BookController@store')->name('admin.book.store');

		Route::get('/view/{encrypted_id}', 'Backend\BookController@view')->name('admin.book.view');
		Route::post('/view/{encrypted_id}', 'Backend\BookController@postComment')->name('admin.book.comment');
		Route::post('/view/{encrypted_id}/axios', 'Backend\BookController@axios_postComment')->name('admin.book.axios_comment');
		Route::get('/view/{encrypted_id}/axios', 'Backend\BookController@axios_getComment')->name('admin.book.axios_get_comment');
		Route::get('/view/{encrypted_id}/axios/{comment_id}', 'Backend\BookController@axios_deleteComment')->name('admin.book.axios_delete_comment');
		Route::get('/view/{encrypted_id}/accept/{slug}', 'Backend\BookController@accept')->name('admin.book.view_accept');
		Route::get('/view/{encrypted_id}/{user_id}', 'Backend\BookController@confirm_accept')->name('admin.book.confirm_accept');
		
		Route::get('/accept/{encrypted_id}', 'Backend\BookController@accept')->name('admin.book.accept');
		Route::get('/edit/{encrypted_id}', 'Backend\BookController@edit')->name('admin.book.edit');
		Route::post('/edit/{encrypted_id}', 'Backend\BookController@update')->name('admin.book.update');
		Route::get('/delete/{encrypted_id}', 'Backend\BookController@delete')->name('admin.book.delete');
	});
	
    /**	
    * WishList	
    **/	
    Route::group(['prefix' => 'wish_list'], function(){	
        Route::get('/', 'Backend\WishListController@index')->name('admin.wish_list.index');	
        Route::post('/add', 'Backend\WishListController@store')->name('admin.wish_list.store');
        Route::post('/edit/{encrypted_id}', 'Backend\WishListController@update')->name('admin.wish_list.update');	
        Route::get('/delete/{encrypted_id}', 'Backend\WishListController@delete')->name('admin.wish_list.delete');	
    });	

    /**
	* Visitor
	**/
	Route::group(['prefix' => 'visitor'], function(){
		Route::match(['GET', 'POST'], '/', 'Backend\VisitorController@index')->name('admin.visitor.index');
		Route::match(['GET', 'POST'], '/country', 'Backend\VisitorController@country')->name('admin.visitor.country');

		Route::post('/add', 'Backend\VisitorController@store')->name('admin.visitor.store');
		Route::post('/edit/{encrypted_id}', 'Backend\VisitorController@update')->name('admin.visitor.update');
		Route::get('/delete/{encrypted_id}', 'Backend\VisitorController@delete')->name('admin.visitor.delete');

	});


	/**
	* Monitor
	**/
	Route::group(['prefix' => 'monitor'], function(){
		Route::match(['GET', 'POST'], '/', 'Backend\MonitorController@index')->name('admin.monitor.index');
		Route::get('/add', 'Backend\MonitorController@add')->name('admin.monitor.add');
		Route::post('/add', 'Backend\MonitorController@store')->name('admin.monitor.store');
		Route::get('/view/{encrypted_id}', 'Backend\MonitorController@view')->name('admin.monitor.view');
		Route::get('/edit/{encrypted_id}', 'Backend\MonitorController@edit')->name('admin.monitor.edit');
		Route::post('/edit/{encrypted_id}', 'Backend\MonitorController@update')->name('admin.monitor.update');
		Route::get('/delete/{encrypted_id}', 'Backend\MonitorController@delete')->name('admin.monitor.delete');
	});
	
});


Route::get('language/{locale}', 'Frontend\LanguageController@index')->name('language');
