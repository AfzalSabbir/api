<?php
namespace App\Helpers;

use App\Helpers\ArrayHelper;

class ArrayHelper
{
  public static function count_dimension($Array, $count = 0) {
    if(is_array($Array)) {
      return ArrayHelper::count_dimension(current($Array), ++$count);
    } else {
      return $count;
    }
  }
}
