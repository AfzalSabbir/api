<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileVerification extends Model
{
	use SoftDeletes;

    public $table = 'mobile_verifications';

    protected $fillable = [
		'admin_id', 'email', 'code', 'token'
    ];
}
