<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = ['name', 'bn_name', 'slug', 'url', 'status', 'district_id'];
}
