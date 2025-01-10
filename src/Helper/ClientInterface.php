<?php
namespace Hutchh\SmsNotification\Helper;
interface ClientInterface{
    function sendSms(string $phoneNumber, string $message);
}