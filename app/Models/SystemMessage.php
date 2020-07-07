<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemMessage extends Model
{
    protected $fillable = ['admin_id', 'message_notification_id', 'status'];
}
