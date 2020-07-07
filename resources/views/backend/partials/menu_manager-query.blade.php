@php

  $nav_data = \App\Models\Menu::where('status', '1')->get()->keyBy('id')->groupBy('menu_position', true);
  $temp__data = [];
  $temp_nav_data = [];
  $i1 = 0; $i2 = 0; $i3 = 0;
  
  foreach ($nav_data as $key => $value) {

    foreach ($value as $k => $val) {
      if ($val->parent_id == "" && $val->menu_position == 2) {
        $temp_nav_data[$val->id] = $val->toArray();
        $temp = \App\Models\Menu::where(['status'=>'1', 'parent_id'=>$val->id])->get()->toArray();
        $temp = !empty($temp) ? $temp:[];
        if(!empty($temp)){

          foreach ($temp as $k_temp => $val_temp) {
            $temp_nav_data[$val->id]['childs'] = $val_temp;

            $temp2 = \App\Models\Menu::where(['status'=>'1', 'parent_id'=>$val_temp['id']])->get()->toArray();
            $temp2 = !empty($temp2) ? $temp2:[];
            if(!empty($temp2)){

              foreach ($temp2 as $k_temp2 => $val_temp2) {
                $temp_nav_data[$val->id]['childs']['childs'][$k_temp2] = $val_temp2;
                $temp3 = \App\Models\Menu::where(['status'=>'1', 'parent_id'=>$val_temp2['id']])->get()->toArray();
                $temp3 = !empty($temp3) ? $temp3:[];
                if(!empty($temp3)){

                  foreach ($temp3 as $k_temp3 => $val_temp3) {
                    $temp_nav_data[$val->id]['childs']['childs'][$k_temp2]['childs'][] = $val_temp3;
                  }
                }
                $i3++;
              }
              $i3 = 0;
            }
            $i2++;
          }
          $i2 = 0;
        }
        $i1++;
      }
      $i1 = 0;
    }
  }
  // dd($temp_nav_data, $i1, $i2, $i3);
@endphp