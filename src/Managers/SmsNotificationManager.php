<?php
namespace Hutchh\SmsNotification\Managers;

use Illuminate\Support\Manager;
use Hutchh\SmsNotification\Helper;

class SmsNotificationManager extends Manager
{
    public function getDefaultDriver(){
        return $this->config->get('smsnotification.driver','twilio');
    }

    protected function createTwilioDriver(){
        $config = $this->config->get('smsnotification.twilio', []);
        return new Helper\Twilio\TwilioClient($config);
    }

    public function sendSms($to, $message){
        return $this->driver()->sendSms($to, $message);
    }

    public function voiceSms($to, $otpCode){
        return $this->driver()->voiceSms($to, $otpCode);
    }

    public function validate($phoneNumber){
        return $this->driver()->validate($phoneNumber);
    }

    public function voiceMessage($otpCode){
        return $this->driver()->voiceMessage($otpCode);
    }

}