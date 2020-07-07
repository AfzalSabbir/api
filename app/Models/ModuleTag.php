<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleTag extends Model
{
	// use SoftDeletes;
	
    protected $fillable = ['tag', 'status', 'trash'];
}
