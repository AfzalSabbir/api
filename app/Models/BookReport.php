<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookReport extends Model
{
	use SoftDeletes;


    protected $fillable = ['id', 'admin_id', 'book_id', 'status'];
    
}
