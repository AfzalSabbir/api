<?php

namespace App\Helpers;

use Image;
use Request;
use File;

class ImageUploadHelper
{

  /**
  * [smartSingleImageUpload description]
  * @param  [type] $request         [Full Request]
  * @param  [type] $target_location [Upload Location]
  * @param  [type] $input_name      [Input Name]
  * @param  [type] $slug            [Photo Name]
  * @return [type] $real_name       [File Name]
  */
  public static function smartSingleImageUpload($request, $target_location, $input_name='image', $slug='')
  {

    $width  = getimagesize($request->$input_name)[0];
    $width  = (int)$width > 512 ? 512:(int)$width;
    $height = (int)(1.2 * (int)$width);

    $width_low = '200';
    $height_low = '240';

    if (request::isMethod('post')) {
      $request->validate([
        "$input_name" => 'required|image|mimes:jpeg,jpg,png,gif|max:2048'
      ]);

      $random = rand(1111,9999);

      if ($random%2 == 0) {
        $base_name = $random.'_'.time();
      } else {
        $base_name = time().'_'.$random;
      }
      $file_name = preg_replace('/\s+/', '_', pathinfo($request->$input_name->getClientOriginalName(), PATHINFO_FILENAME));

      $file_extension = $request->$input_name->getClientOriginalExtension();
      $real_name = $base_name.'-'.$slug.'.'.$file_extension;

      /*
        $filename = $name . '.' . $file->getClientOriginalExtension();
        $location = ($target_location.'/'.$filename);
        Image::make($file)->resize($width, $height)->save($location);
        request()->$input_name->move($target_location, $real_name);
      */
       
      $location = ($target_location.'original/'.$real_name);
      Image::make(request()->$input_name)->resize($width, $height)->save($location);

      $location = ($target_location.'low/'.$real_name);
      Image::make(request()->$input_name)->resize($width_low, $height_low)->save($location);


      return $real_name;
    }

  }
  public static function smartSingleImageUpdate($request, $target_location, $input_name='image', $old_file)
  {

    if (request::isMethod('post')) {
      $request->validate([
        "$input_name" => 'required|image|mimes:jpeg,jpg,png,gif|max:2048'
      ]);

      $random = rand(1111,9999);

      if ($random%2 == 0) {
        $base_name = $random.'_'.time();
      } else {
        $base_name = time().'_'.$random;
      }
      $file_name = preg_replace('/\s+/', '_', pathinfo($request->$input_name->getClientOriginalName(), PATHINFO_FILENAME));
      $file_extension = $request->$input_name->getClientOriginalExtension();
      $real_name = $base_name.'_'.$file_name.'.'.$file_extension;

      request()->$input_name->move($target_location, $real_name);
      
      if (file_exists($old_file)) {
        unlink($old_file);
      }
      return $real_name;
    }

  }


  public static function profilePhotoUpdate($request, $target_location, $input_name='image', $slug='')
  {
    $default_photo = 'public/images/default.png';
    // $width = getimagesize($request->$input_name)[0];
    $width = 400;
    $height = (int)$width;

    $width_low = '200';
    $height_low = '200';

    if (request::isMethod('post')) {
      $old_photo = $request->old_image;

      // return change_quality($old_photo);

      $request->validate([
        "$input_name" => 'required|image|mimes:jpeg,jpg,png,gif|max:1200',
        "old_".$input_name => 'required',
      ]);

      $random = rand(1111,9999);

      if ($random%2 == 0) {
        $base_name = $random.'_'.time();
      } else {
        $base_name = time().'_'.$random;
      }
      $file_name = preg_replace('/\s+/', '_', pathinfo($request->$input_name->getClientOriginalName(), PATHINFO_FILENAME));

      $file_extension = $request->$input_name->getClientOriginalExtension();
      $real_name = $base_name.'-'.$slug.'.'.$file_extension;

      $old_original = change_quality($old_photo);
      $location = ($target_location.'original/'.$real_name);
      Image::make(request()->$input_name)->resize($width, $height)->save($location);
      if ($default_photo != $old_photo && file_exists($old_original)) {
        unlink($old_original);
      }

      $location = ($target_location.'low/'.$real_name);
      Image::make(request()->$input_name)->resize($width_low, $height_low)->save($location);
      if ($default_photo != $old_photo && file_exists($old_photo)) {
        unlink($old_photo);
      }


      return $real_name;
    }
    else {
      return 0;
    }

  }


  /**
  * [upload description]
  * @param  [type] $image           [description]
  * @param  [type] $file            [description]
  * @param  [type] $slug            [description]
  * @param  [type] $target_location [description]
  * @return [type]                  [description]
  */
  public static function upload($image, $file, $name, $target_location, $width=500, $height=500)
  {
    if(Request::hasFile($image)){
      $filename = $name . '.' . $file->getClientOriginalExtension();
      $location = ($target_location.'/'.$filename);
      Image::make($file)->resize($width, $height)->save($location);
      return $filename;
    }
  }


  public static function update($image, $file, $name, $target_location, $old_location, $width=500, $height=500)
  {
    if(Request::hasFile($image)){
      $filename = $name. '.'.$file->getClientOriginalExtension();
      File::delete($old_location);
      $location = ($target_location.'/'.$filename);
      Image::make($file)->resize($width, $height)->save($location);
      return $filename;
    }
  }

  public static function delete($target_location)
  {
    if (File::exists($target_location)) {
      File::delete($target_location);
    }
  }



  
  public static function uploadWithResize($image, $file, $name, $target_location, $width="128", $hieght="128")
  {
    if(Request::hasFile($image)){
      $filename = $name . '.' . $file->getClientOriginalExtension();
      $location = ($target_location.'/'.$filename);
      Image::make($file)->resize($width,$hieght)->save($location);
      return $filename;
    }
  }


  public static function uploadWithOriginalSize($image, $file, $name, $target_location)
  {
    if(Request::hasFile($image)){
      $filename = $name . '.' . $file->getClientOriginalExtension();
      $location = ($target_location.'/'.$filename);
      Image::make($file)->save($location);
      return $filename;
    }
  }


  public static function updateWithResize($image, $file, $name, $target_location, $old_location, $width="128", $hieght="128")
  {
    if(Request::hasFile($image)){
      $filename = $name. '.'.$file->getClientOriginalExtension();
      File::delete($old_location);
      $location = ($target_location.'/'.$filename);
      Image::make($file)->resize($width, $hieght)->save($location);
      return $filename;
    }
  }


  public static function updateWithOriginalSize($image, $file, $name, $target_location, $old_location)
  {
    if(Request::hasFile($image)){
      $filename = $name. '.'.$file->getClientOriginalExtension();
      File::delete($old_location);
      $location = ($target_location.'/'.$filename);
      Image::make($file)->save($location);
      return $filename;
    }
  }

}
