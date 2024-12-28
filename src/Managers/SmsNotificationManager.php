<?php
namespace Hutchh\SmsNotification\Managers;

use Illuminate\Support\Manager;
use Illuminate\Support\Facades\Log;

class SmsNotificationManager extends Manager
{
    public function getDefaultDriver(){
        return $this->config->get('smsnotification.driver','twillio');
    }

    protected function createTwillioDriver(){
        $config = $this->config->get('smsnotification.twillio', []);
        return new Helper\Twillio\TwillioClient($config);
    }

    
}