<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitutionName extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = ['i_code', 'i_name'];

}
