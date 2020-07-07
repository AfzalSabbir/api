<?php
namespace App\Helpers;
use App\Helpers\FileHelper;
use Session;

class FileHelper
{
  /** i.e.
  *
  * [Varies]    @base             : 'app/Http/Controllers/Backend'    #WHERE TO FIND
  * [Varies]    @controller_name  : 'ThisController'                  #EXISTING CONTROLLER NAME
  * [Constant]  @all_data         : '{ It'll get auto! }'             #CONTROLLER CONTAINS
  *
  * CALL  >>>>  App\Helpers\FileHelper::read_and_write($base, $CreateDController, $data); 
  **/
  public static function read_and_write($base, $file_name, $all_data)
  {
    $controller = $file_name.'.php';

    $directory = $base.'/'.$controller;
    $reading = file($directory);
    $fp = fopen($directory, 'w');
    fwrite($fp, implode('', $reading));
    fclose($fp);

    return file_put_contents($directory, $all_data);
  }

  /** i.e.
  *
  * [Varies]    @base             : 'app/Http/Controllers/Backend'    #WHERE TO FIND
  * [Varies]    @controller_name  : 'ThisController'                  #CONTROLLER NAME
  *
  * CALL  >>>>  App\Helpers\FileHelper::read($base, $CreateDController); 
  **/
  public static function read($base, $file_name)
  {
    $controller = $file_name.'.php';

    $directory = $base.'/'.$controller;
    $reading = file($directory);

    return $reading;
  }

  /** i.e.
  *
  * [Varies]    @full_path    : 'app/Http/Controllers/Backend/HomeController.php'    #WHAT TO FIND
  *
  * CALL  >>>>  App\Helpers\FileHelper::read_any($file_name_with_path); 
  **/
  public static function read_any($full_path)
  {
    $directory = $full_path;
    $reading = file($directory);
    
    return $reading;
  }


  /** i.e.
  *
  * [Varies]    @base             : 'app/Http/Controllers/Backend'    #WHERE TO FIND
  * [Varies]    @file_name        : 'web'                             #EXISTING FILE NAME
  * [Constant]  @all_data         : '{ It'll get auto! }'             #NEW ROUTES
  *
  * CALL  >>>>  App\Helpers\FileHelper::insert($base, $filename, $route_data); 
  **/
  public static function insert($base, $file_name, $all_data)
  {
    $reading = FileHelper::read($base, $file_name);

    foreach (array_reverse($reading, true) as $key => $value) {
      if ($value == "});\r\n" || $value == "});") {
        $admin_closes = $key;
        break;
      }
    }
    $reading_part = array_chunk($reading, $admin_closes);
    $new_route = array_merge($reading_part[0], explode("\r\n", $all_data));
    $new_route = array_merge($new_route, $reading_part[1]);

    FileHelper::read_and_write($base, $file_name, $new_route);

    return true;
  }

  /** i.e.
  *
  * [Varies]    @full_path    : 'app/Http/Controllers/Backend/HomeController.php'   #WHAT TO FIND
  * [Constant]  @all_data     : '{ It'll get auto! }'                               #NEW ROUTES
  *
  * CALL  >>>>  App\Helpers\FileHelper::insert_any($file_name_with_path, $data); 
  **/
  public static function insert_any($full_path, $all_data)
  {
    $directory = $full_path;
    $reading = file($directory);
    
    if($full_path == '.env') {
      Session::put('.env', $reading);
    }

    $fp = fopen($directory, 'w');
    fwrite($fp, implode('', $reading));
    fclose($fp);

    file_put_contents($directory, $all_data);
    
    return $reading;
  }
}
