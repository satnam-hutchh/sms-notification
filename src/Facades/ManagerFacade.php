<?php
namespace Hutchh\SmsNotification\Facades;
use Illuminate\Support\Facades\Facade;
use Hutchh\SmsNotification\Managers;

class ManagerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Managers\SmsNotificationManager::class;
    }
}