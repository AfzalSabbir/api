<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailVerification extends Model
{
	use SoftDeletes;

    public $table = 'email_verifications';

    protected $fillable = [
		'admin_id', 'email', 'code', 'token'
    ];
}
