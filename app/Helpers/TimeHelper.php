<?php
namespace App\Helpers;
use Carbon\Carbon;

class TimeHelper
{
  /**
  * Escape Number From String
  */
  public static function simpleDryString($string)
  {
    return preg_replace('/[^0-9.]+/', '',$string);
  }

  /**
  * Mod
  */
  public static function simpleMod($number, $mod)
  {
    if ($number > 0) {
      return $number % $mod;
    } else {
      return 0;
    }
  }

  /**
  * locle diffforhumans
  */
  public static function diffForHumans($data)
  {
    if(is_object($data)) {
      foreach ($data as $key => $value) {
        $data[$key]->created_at_human = num2locale(Carbon::parse($value->created_at)->diffForHumans());
        // $data[$key]->updated_at_human = num2locale(Carbon::parse($value->updated_at)->diffForHumans());
      }
      return $data;
    } else if(is_array($data)) {
      foreach ($data as $key => $value) {
        $data[$key]['created_at_human'] = num2locale(Carbon::parse($value['created_at'])->diffForHumans());
      }
      return $data;
    }
  }

}
