<?php
namespace Hutchh\SmsNotification\Helper;
interface ClientInterface{
    function sendTextSms(string $phoneNumber, string $message);
}