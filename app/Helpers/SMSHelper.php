<?php
namespace App\Helpers;

use App\Models\SmsRecord;
use Auth;
use DB;
use SoapClient;

class SMSHelper
{
    public static function sendSMS($mobile, $text, $messageLength)
    {
        $smsCount = (int) SmsRecord::where('is_send', 1)->sum('sms_count');
        $totalSms = (int) env('SMS_LIMIT');

        if(!is_null($mobile) && !is_null($text) && $totalSms > $smsCount){
            $username = env('SMS_USERNAME');
            $password = env('SMS_PASSWORD');
            $url = env('SMS_URL');
            $mobile = trim($mobile);

            $data = array(
                'mobile' => $mobile,
                'sms' => $text,
                'sending_date' => date('Y-m-d'),
                'send_by' => Auth::guard('admin')->id(),
                'sms_count' => $messageLength
            );

            try {
                $wsdl = $url;
                $options = array(
                  'cache_wsdl' => 0,
                );
                $soapClient = new SoapClient($url);
                $paramArray = array(
                    'userName'    => $username,
                    'userPassword'  => $password,
                    'mobileNumber'  => $mobile,
                    'smsText'   => $text,
                    'type'      => "TEXT",
                    'maskName'    => "",
                    'campaignName'  => ""
                );
                $value = $soapClient->__call("OneToOne", array($paramArray));

                if($value->OneToOneResult == 1900){
                    $data['is_send'] = 1;
                    SmsRecord::insert($data);
                    return response()->json(true);
                }
                else{
                    $data['is_send'] = 0;
                    SmsRecord::insert($data);
                    return response()->json(false);
                }
            }
            catch(Exception $e) {
                echo $e;
            }
        }
    }
}
