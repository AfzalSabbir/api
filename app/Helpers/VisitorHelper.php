<?php
namespace App\Helpers;

use Jenssegers\Agent\Agent;
use App\Models\Visitor;
use App\Models\IpBan;

use Auth, Request, Location;

class VisitorHelper
{
  /**
  * Every Action
  */
  public static function insert_visitor_all()
  {
    $agent = new Agent();

    if($agent->isDesktop()){
      $device = "PC";
    }
    else{
      $device = "Mobile";
    }

    $browser  = $agent->browser();
    $ip       = Request::ip();
    $location = Location::get($ip);
    $url      = Request::getPathInfo();

    // $visitor = Visitor::where(['ip'=> $ip])->orderBy('ban', 'desc')->first();
    // if($visitor && $visitor->ban){
    
    $ban = IpBan::where([['ip', $ip], ['ban_for', '>', date('Y-m-d')]])->first();

    if($ban){
      echo 'IP:<strong style="color:red">'.$ip.'</strong> banned! by webmaster.<br/>If it has happend by mistake or why your IP would not be in the blocklist, knowing contact webmaster: <strong style="color:green"><a href="mailto:'.env('MAIL_TO').'">boinaw.com@gmail.com</a></strong>';
      die();
    }

    $data = array(
      'admin_id'  => Auth::guard('admin')->check()?Auth::guard('admin')->user()->id:0,
      'ip'        => $ip,
      'country'   => $location ? $location->countryCode:'',
      'device'    => $device,
      'browser'   => $browser,
      'url'       => $url
    );
    $data['visit'] = 1;
    // dd($data);
    Visitor::create($data);
    
    return $data;
  }


  public static function insert_visitor()
  {
    $agent = new Agent();

    if($agent->isDesktop()){
      $device = "PC";
    }
    else{
      $device = "Mobile";
    }

    $browser  = $agent->browser();
    $ip       = Request::ip();
    $location = Location::get($ip);
    $url      = Request::getPathInfo();

    // $visitor = Visitor::where(['ip'=> $ip])->orderBy('ban', 'desc')->first();
    // if($visitor && $visitor->ban){
    
    $ban = IpBan::where([['ip', $ip], ['ban_for', '>', date('Y-m-d')]])->first();

    if($ban){
      echo 'IP:<strong style="color:red">'.$ip.'</strong> banned! by webmaster.<br/>If it has happend by mistake or why your IP would not be in the blocklist, knowing contact webmaster: <strong style="color:green"><a href="mailto:'.env('MAIL_TO').'">boinaw.com@gmail.com</a></strong>';
      die();
    }

    $data = array(
      'admin_id'  => Auth::guard('admin')->check()?Auth::guard('admin')->user()->id:0,
      'ip'        => $ip,
      'country'   => $location ? $location->countryCode:'',
      'device'    => $device,
      'browser'   => $browser,
      'url'       => $url
    );

    if ($visitor = Visitor::where(['ip'=> $ip, 'url'=> $url])->first()) {
      $data['visit'] = $visitor->visit + 1;
      $visitor->update($data);
    } else {
      $data['visit'] = 1;
      Visitor::create($data);
    }
    return $data;
  }

}
