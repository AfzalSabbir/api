<?php

use \App\Models\Admin;

// asset_() works similler as asset() but for public inclusion!!!
if (! function_exists('asset_')) {
    function asset_($path = null, $default = null) {
    	return asset('/').trim($path, '/');
    }
}

if (! function_exists('base_url')) {
    function base_url() {
    	return URL::to('/');
    }
}


if (! function_exists('num2locale')) {
    function num2locale($str) {
        $e2b = ['0'=>'০','1'=>'১','2'=>'২','3'=>'৩','4'=>'৪','5'=>'৫','6'=>'৬','7'=>'৭','8'=>'৮','9'=>'৯'];
        if (app()->getLocale() == 'bn') {
            return strtr($str, $e2b);
        } else {
            return $str;
        }
    }
}
if (! function_exists('n2l')) {
    function n2l($str) {
        return num2locale($str);
    }
}

if (! function_exists('num2bn')) {
    function num2bn($str) {
        $e2b = ['0'=>'০','1'=>'১','2'=>'২','3'=>'৩','4'=>'৪','5'=>'৫','6'=>'৬','7'=>'৭','8'=>'৮','9'=>'৯'];
        return strtr($str, $e2b);
    }
}
if (! function_exists('n2b')) {
    function n2b($str) {
        return num2bn($str);
    }
}

if (! function_exists('lang')) {
    function lang() {
        return app()->getLocale();
    }
}

if (! function_exists('get_lang')) {
    function get_lang() {
        return app()->getLocale();
    }
}

if (! function_exists('get_locale')) {
    function get_locale() {
        return app()->getLocale();
    }
}

if (! function_exists('check_locale')) {
    function check_locale($lang) {
        return app()->getLocale() == $lang;
    }
}

if (! function_exists('check_lang')) {
    function check_lang($lang) {
        return app()->getLocale() == $lang;
    }
}

if (! function_exists('change_admin_language')) {
    function change_admin_language($lang) {
        if(Auth::guard('admin')->check()) {
            $id = Auth::guard('admin')->id();
            if ($lang == 'en') {
                return \App\Models\Admin::where('id', $id)->update(['language' => 'en']);
            } else {
                return \App\Models\Admin::where('id', $id)->update(['language' => 'bn']);
            }
        } else {
            return 0;
        }
    }
}

if (! function_exists('show_route')) {
    function show_route($model, $resource = null)
    {
        $resource = $resource ?? plural_from_model($model);

        return route("{$resource}.show", $model);
    }
}

if (! function_exists('encrypt_me')) {
    function encrypt_me($decrypted)
    {
        $ax = $decrypted;

        $b = array_reverse(str_split(base64_encode(rand(100, 999).$ax.rand(10, 99))));
        $salt = str_split("12345ASDFGHJKLqwertyuiopZXCVBNMasdfghjklQWERTYUIOzxcvbnm67890");
        $x = [];
        foreach ($b as $key => $value) {
            $x[2*$key] = $b[$key];
            $x[2*$key+1] = $salt[array_rand($salt, true)];
        }

        $ax = implode($x);

        $b = array_reverse(str_split(base64_encode(rand(100, 999).$ax.rand(10, 99))));
        $salt = str_split("12345ASDFGHJKLqwertyuiopZXCVBNMasdfghjklQWERTYUIOzxcvbnm67890");
        $x = [];
        foreach ($b as $key => $value) {
            $x[2*$key] = $b[$key];
            $x[2*$key+1] = $salt[array_rand($salt, true)];
        }

        return implode($x);
    }
}

if (! function_exists('decrypt_me')) {
    function decrypt_me($encrypted)
    {
        $ax = $encrypted;

        $b = str_split($ax);
        $even_position = [];
        foreach($b as $key => $value) {
            if($key%2==0) $even_position[] = $b[$key];
        }
        $d1 = base64_decode(implode(array_reverse($even_position)));
        $s1 = substr($d1, 3);

        $ax = substr($s1, 0, strlen($s1)-2);

        $b = str_split($ax);
        $even_position = [];
        foreach($b as $key => $value) {
            if($key%2==0) $even_position[] = $b[$key];
        }
        $d1 = base64_decode(implode(array_reverse($even_position)));
        $s1 = substr($d1, 3);
        
        return substr($s1, 0, strlen($s1)-2);

    }
}

if (! function_exists('encode_base64')) {
    function encode_base64($str, $urlencode = true)
    {
        if ($urlencode) {
            $left       = generateRandomString(3);
            $left_1     = generateRandomString(3);
            $mid        = $str;
            $right      = generateRandomString(4);
            $right_1    = generateRandomString(4);

            $new_str_1  = $left.''.$mid.''.$right;
            $base_1     = base64_encode($new_str_1);

            $new_str_2  = $right_1.$left_1.$base_1;
            $base_2     = base64_encode($new_str_2);

            $base_3     = base64_encode($base_2);

            $str        = urlencode($base_3);
        }
        return $str;
    }
}

if (! function_exists('decode_base64')) {
    function decode_base64($str, $urldecode = true)
    {
        if ($urldecode) {
            $str = urldecode($str);
            $str = base64_decode($str);
            $str = base64_decode($str);
            $str = substr($str, 7);
            // $str = substr($str, 0, strlen($str)-3);
            $str = base64_decode($str);
            $str = substr($str, 3);
            $str = substr($str, 0, strlen($str)-4);
        }
        return $str;
    }
}

if (! function_exists('generateRandomString')) {
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (! function_exists('change_quality')) {
    function change_quality($image_url, $to='original') {
        if ($to == 'original') {
            return str_replace('/low/', '/original/', $image_url);
        }
        else {
            return str_replace('/original/', '/low/', $image_url);
        }
    }
}

if (! function_exists('switch_quality')) {
    function switch_quality($image_url, $to='original') {
        if ($to == 'original') {
            return str_replace('/low/', '/original/', $image_url);
        }
        else {
            return str_replace('/original/', '/low/', $image_url);
        }
    }
}

if (! function_exists('get_mac')) {
    function get_mac() {
        return substr(exec('getmac'), 0, 17);
    }
}

if (! function_exists('get_mac_or_ip')) {
    function get_mac_or_ip() {
        $mac = substr(exec('getmac'), 0, 17);
        $ip = \Request::ip();
        return strlen($mac) == 17 ? $mac:$ip;
    }
}

if (! function_exists('add_days')) {
    function add_days($date, $days=1, $format='Y-m-d') {
        return date($format, strtotime('+'.$days.' days', strtotime(date($date))));
    }
}
if (! function_exists('sub_hours')) {
    function sub_hours($date, $hours=0, $format='Y-m-d H:i:s') {
        return date($format, strtotime('-'.$hours.' hours', strtotime(date($date))));
    }
}
if (! function_exists('my_date')) {
    function my_date($date, $position='from') {

        if($position == 'from')  $format = 'Y-m-d 00:00:00';
        else                $format = 'Y-m-d 23:59:59';

        return date($format, strtotime(date($date)));
    }
}