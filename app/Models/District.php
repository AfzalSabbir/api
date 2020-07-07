<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = ['name', 'bn_name', 'slug', 'url', 'division_id', 'status'];
}
