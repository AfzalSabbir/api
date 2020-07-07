<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookComment extends Model
{
	use SoftDeletes;

    protected $fillable = ['book_id', 'admin_id', 'book_x', 'admin_x', 'comment_body', 'status'];

    // public function getCreatedAtAttribute($date)
    // {
    // 	return n2l(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans());
    // }

    // public function getUpdatedAtAttribute($date)
    // {
    // 	return n2l(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans());
    // }

    // public function getDeletedAtAttribute($date)
    // {
    // 	return n2l(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans());
    // }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
