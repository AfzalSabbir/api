<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Admin;

class Message extends Model
{

	use SoftDeletes;

    protected $fillable = ['admin_id', 'message_subject', 'message_body', 'message_type', 'book_id', 'book_accept_history_id', 'status', 'updated'];



    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function sender()
    {
        return $this->belongsTo('App\Models\Admin', 'sender_id');
    }
}
