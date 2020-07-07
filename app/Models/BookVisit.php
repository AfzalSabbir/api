<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookVisit extends Model
{
	use SoftDeletes;


    protected $fillable = ['id', 'admin_id', 'mac_or_ip', 'book_id', 'status'];

}
