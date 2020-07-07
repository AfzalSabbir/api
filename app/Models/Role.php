<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['menu', 'sub_menu', 'in_body', 'inner_in_body', 'role', 'admin_id', 'status'];

    public function menu()
    {
    	return $this->belongsTo(Menu::class);
    }

    public static function checkedMenu($menuId, $menus)
    {
    	if($menus){
            foreach ($menus as $menu) {
                if($menu == $menuId){
                    return 'checked';
                    break;
                }
            }
        }
        else{
            return "";
        }
    }


    public static function checkRightTopPermission($menu_id)
    {
        $permissions = \App\Models\Role::where('role', \Auth::guard('admin')->id())->first();
        if($permissions){
            foreach(json_decode($permissions->menu) as $permission){
                if($permission == $menu_id){
                    return true;
                    break;
                }
            }
        }
        else{
            return false;
        }
    }
}
