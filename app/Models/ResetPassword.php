<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResetPassword extends Model
{
	use SoftDeletes;

    public $table = 'password_resets';

    protected $fillable = [
		'admin_id', 'email', 'code', 'token', 'old_password'
    ];
}
