<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = ['name', 'upazila_id', 'bn_name', 'slug', 'url', 'status'];
}
