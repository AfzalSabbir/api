<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpBan extends Model
{
	use SoftDeletes;
	
    protected $table = 'ip_bans';

    protected $fillable = ['id', 'admin_id', 'ip', 'ban_for', 'created_at', 'updated_at', 'deleted_at'];
}