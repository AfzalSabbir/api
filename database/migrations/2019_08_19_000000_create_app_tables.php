<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('admins', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('id')->unsigned();
		    $table->string('name', 191);
		    $table->string('email', 191);
		    $table->string('username', 191);
		    $table->boolean('admin_role')->default(null);
		    $table->string('language', 191)->default('en');
		    $table->string('photo', 191)->default(null);
		    $table->string('password', 191);
		    $table->string('remember_token', 100)->default(null);
		    $table->boolean('status')->unsigned()->default('1');
		    $table->boolean('trash')->default('0')->comment('1: Deleted');
		    $table->time('created_at')->nullable()->default(null);
		    $table->time('updated_at')->nullable()->default(null);
		    $table->time('deleted_at')->nullable()->default(null);
		
		    $table->timestamps();
		
		});

		Schema::create('admin_access_infos', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('id')->unsigned();
		    $table->integer('admin_id')->unsigned();
		    $table->string('ip', 191)->default(null);
		    $table->string('country', 191)->default(null);
		    $table->string('device', 191)->default(null);
		    $table->string('browser', 191)->default(null);
		    $table->boolean('status')->unsigned()->default('1');
		    $table->time('created_at')->nullable()->default(null);
		    $table->time('updated_at')->nullable()->default(null);
		
		    $table->timestamps();
		
		});

		Schema::create('menus', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('id')->unsigned();
		    $table->string('menu', 191);
		    $table->string('menu_bn', 191);
		    $table->integer('parent_id')->unsigned()->default(null);
		    $table->integer('menu_position')->unsigned()->default(NULL);
		    $table->string('icon', 191)->default(null);
		    $table->string('icon_color', 50)->default('#ffffff');
		    $table->string('url', 191)->default(null);
		    $table->string('route', 191)->default(null);
		    $table->text('parameter');
		    $table->integer('order')->unsigned();
		    $table->boolean('status')->unsigned()->default('1');
		    $table->boolean('trash')->default('0')->comment('1: Deleted');
		    $table->time('created_at')->nullable()->default(null);
		    $table->time('updated_at')->nullable()->default(null);
		    $table->time('deleted_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
		
		    $table->timestamps();
		
		});

		Schema::create('migrations', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('id')->unsigned();
		    $table->string('migration', 191);
		    $table->integer('batch');
		
		    $table->timestamps();
		
		});

		Schema::create('modules', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('id')->unsigned();
		    $table->string('title', 191);
		    $table->text('files');
		    $table->integer('admin_id');
		    $table->text('description');
		    $table->string('module_tag_id', 191)->default('[""]');
		    $table->boolean('status')->default('1')->comment('1: Active');
		    $table->boolean('trash')->default('0')->comment('1: Deleted');
		    $table->time('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
		    $table->time('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
		    $table->time('deleted_at')->nullable()->default(null);
		
		    $table->timestamps();
		
		});

		Schema::create('module_tags', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('id')->unsigned();
		    $table->string('tag', 191);
		    $table->boolean('status')->default('1')->comment('1: Active');
		    $table->boolean('trash')->default('0')->comment('1: Deleted');
		    $table->time('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
		    $table->time('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
		    $table->time('deleted_at')->nullable()->default(null);
		
		    $table->timestamps();
		
		});

		Schema::create('password_resets', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->string('email', 191);
		    $table->string('token', 191);
		    $table->time('created_at')->nullable()->default(null);
		
		    $table->timestamps();
		
		});

		Schema::create('roles', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('id')->unsigned();
		    $table->text('menu');
		    $table->text('sub_menu');
		    $table->text('in_body');
		    $table->text('inner_in_body');
		    $table->integer('admin_id')->default(null);
		    $table->boolean('role')->unsigned();
		    $table->boolean('status')->unsigned()->default('1');
		    $table->boolean('trash')->default('0')->comment('1: Deleted');
		    $table->time('created_at')->nullable()->default(null);
		    $table->time('updated_at')->nullable()->default(null);
		    $table->time('deleted_at')->nullable()->default(null);
		
		    $table->timestamps();
		
		});

		Schema::create('settings', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('id')->unsigned();
		    $table->string('logo', 191);
		    $table->string('favicon', 191);
		    $table->string('title_en', 191);
		    $table->string('title_bn', 191)->default(null);
		    $table->boolean('color_scheme_id');
		    $table->string('email', 191);
		    $table->string('mobile', 30);
		    $table->string('facebook', 191);
		    $table->string('twitter', 191);
		    $table->string('youtube', 191);
		    $table->string('linkedin', 191);
		    $table->text('address');
		    $table->boolean('status')->default('1');
		    $table->time('created_at')->nullable()->default(null);
		    $table->time('updated_at')->nullable()->default(null);
		    $table->boolean('custom_scroll')->default('1');
		    $table->boolean('show_user_data')->default('1');
		    $table->boolean('show_background_image')->default('0');
		    $table->boolean('show_dev_menu')->default('1');
		
		    $table->timestamps();
		
		});

		Schema::create('sms_records', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('id');
		    $table->string('mobile', 15);
		    $table->longText('sms');
		    $table->date('sending_date')->default(null);
		    $table->boolean('sms_count')->default('1');
		    $table->integer('send_by')->default(null);
		    $table->boolean('is_send')->default('1');
		
		    $table->timestamps();
		
		});

		Schema::create('themes', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('id')->unsigned();
		    $table->integer('admin_id');
		    $table->string('theme_title', 191);
		    $table->text('theme_data');
		    $table->boolean('status')->default('1')->comment('1: Active');
		    $table->boolean('trash')->default('0')->comment('1: Deleted');
		    $table->time('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
		    $table->time('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
		    $table->time('deleted_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
		
		    $table->timestamps();
		
		});

		Schema::create('users', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->bigInteger('id')->unsigned();
		    $table->string('name', 191);
		    $table->string('email', 191);
		    $table->time('email_verified_at')->nullable()->default(null);
		    $table->string('password', 191);
		    $table->string('remember_token', 100)->default(null);
		    $table->time('created_at')->nullable()->default(null);
		    $table->time('updated_at')->nullable()->default(null);
		
		    $table->timestamps();
		
		});


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('users');
		Schema::drop('themes');
		Schema::drop('sms_records');
		Schema::drop('settings');
		Schema::drop('roles');
		Schema::drop('password_resets');
		Schema::drop('module_tags');
		Schema::drop('modules');
		Schema::drop('migrations');
		Schema::drop('menus');
		Schema::drop('admin_access_infos');
		Schema::drop('admins');

    }
}
