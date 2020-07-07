<?php
namespace App\Helpers;

use App\Models\Menu;
use App\Helpers\ModuleHelper;
use config;

class ModuleHelper
{

  //['Sidebar', 'In Body', 'Nav Right', 'Nav Right In', 'Nav Left', 'Nav Left In']
  public static function get_all_menu($order=null)
  {
    $nav_data_object = \App\Models\Menu::where('status', '1');
    foreach ($order as $key => $value) {
      $nav_data_object->orderBy($key, $value);
    }
    $nav_data = $nav_data_object->get()->keyBy('id')->toArray();

    $result = [];
    foreach ($nav_data as $key => $value) {
      if($value['parent_id'] == ""){
        $result[$key] = $value;
        $value_result = ModuleHelper::check_childs($nav_data, $value);
        $result[$key]['childs'] = $value_result;
        foreach ($value_result as $k => $val) {
          $val_result = ModuleHelper::check_childs($nav_data, $val);
          $result[$key]['childs'][$k]['childs'] = $val_result;

          foreach ($val_result as $k1 => $val1) {
            $val1_result = ModuleHelper::check_childs($nav_data, $val1);
            $result[$key]['childs'][$k]['childs'][$k1]['childs'] = $val1_result;

            foreach ($val1_result as $k2 => $val2) {
              $val2_result = ModuleHelper::check_childs($nav_data, $val2);
              $result[$key]['childs'][$k]['childs'][$k1]['childs'][$k2]['childs'] = $val2_result;

              foreach ($val2_result as $k3 => $val3) {
                $val3_result = ModuleHelper::check_childs($nav_data, $val3);
                $result[$key]['childs'][$k]['childs'][$k1]['childs'][$k2]['childs'][$k3]['childs'] = $val3_result;
                // dd('val3_result: ', $val3_result, $result);
              }
              // dd('val2_result: ', $val2_result, $result);
            }
            // dd('val1_result: ', $val1_result, $result);
          }
          // dd('val_result: ', $val_result, $result);
        }
      }
    }
    // dd($result);

    return $result;
  }
  
  public static function check_childs($data, $datum, $result = [])
  {
    foreach ($data as $key => $value) {
      if ($value['parent_id'] == $datum['id']) {
        $result[] = $value;
      }
    }
    return $result;
  }

  /**
   * 
   * @var $key [Menu Position (x∈Z : 0<=x<=5)]
   * 
   /******************************************/
  public static function get_menu_by_position($key)
  {
    // Config::get('custom.menu')[$key];
    $result = ModuleHelper::get_all_menu(['order'=>'desc']);
    $temp_result = [];
    foreach ($result as $k => $value) {
      if ($value['menu_position'] == $key) {
        $temp_result[$k] = $value;
      }
    }
    return $temp_result;
  }


  /**
   * 
   * @var $route [full route]
   * 
   /******************************************/
  public static function get_menu_by_route($route)
  {
    $menu_for_route = Menu::orderBy('parent_id', 'asc')->where('route', $route)->first();
    $parent_id = $menu_for_route->parent_id;
    
    if ($parent_id) {
      for (;;) {
        $parent = Menu::orderBy('parent_id', 'asc')->where('id', $parent_id)->first();
        if($parent->parent_id == null){
          break;
        } else {
          $parent_id = $parent->parent_id;
        }
      }
    } else {
      $parent_id = $menu_for_route->id;
    }

    $result = ModuleHelper::get_all_menu(['order'=>'desc']);
    $temp_result = [];
    foreach ($result as $key => $value) {
      if ($key == $parent_id) {
        $temp_result[$key] = $value;
      }
    }

    return $temp_result;
  }
}
