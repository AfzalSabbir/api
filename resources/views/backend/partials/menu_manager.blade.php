@php

  $nav_data = \App\Models\Menu::where('status', '1')->orderBy('id', 'desc')->get()->keyBy('id')->toArray();

  $result = [];
  foreach ($nav_data as $key => $value) {
    if($value['parent_id'] == ""){
      $result[$key] = $value;
      $value_result = check_childs($nav_data, $value);
      $result[$key]['childs'] = $value_result;
      foreach ($value_result as $k => $val) {
        $val_result = check_childs($nav_data, $val);
        $result[$key]['childs'][$k]['childs'] = $val_result;

        foreach ($val_result as $k1 => $val1) {
          $val1_result = check_childs($nav_data, $val1);
          $result[$key]['childs'][$k]['childs'][$k1]['childs'] = $val1_result;

          foreach ($val1_result as $k2 => $val2) {
            $val2_result = check_childs($nav_data, $val2);
            $result[$key]['childs'][$k]['childs'][$k1]['childs'][$k2]['childs'] = $val2_result;

            foreach ($val2_result as $k3 => $val3) {
              $val3_result = check_childs($nav_data, $val3);
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

  function check_childs($data, $datum, $result = []){
    foreach ($data as $key => $value) {
      if ($value['parent_id'] == $datum['id']) {
        $result[] = $value;
      }
    }
    return $result;
  }
  return $result;
@endphp