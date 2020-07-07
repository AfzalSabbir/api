<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Module;

class Module extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'files', 'admin_id', 'module_tag_id', 'description', 'status', 'trash'];

    public function admin()
    {
    	return $this->belongsTo(Admin::class);
    }

    static function module_tag($id)
    {
    	return $this->belongsTo(ModuleTag::class);
    }
}
