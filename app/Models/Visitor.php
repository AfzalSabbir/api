<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
	use SoftDeletes;
	
    protected $fillable = ['id', 'admin_id', 'ip', 'country', 'device', 'browser', 'url', 'visit', 'ban', 'created_at', 'updated_at', 'deleted_at'];
}