<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookAcceptHistory extends Model
{
    use SoftDeletes;

    protected $fillable = ['admin_id', 'book_id', 'status', 'updated_at'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function who_asked()
    {
        return $this->hasMany(BookAcceptHistory::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
