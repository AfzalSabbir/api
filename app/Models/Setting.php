<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
	use SoftDeletes;
	
	protected $table = "settings";
	
    protected $fillable = ['title_bn', 'title_en', 'description', 'logo', 'favicon', 'email', 'mobile', 'facebook', 'twitter', 'youtube', 'instagram', 'linkedin', 'address', 'theme_id', 'admin_prefix'];
}