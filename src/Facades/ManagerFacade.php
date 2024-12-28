<?php
namespace Hutchh\SmsNotification\Facades;

use Illuminate\Support\Facades\Facade;

class ManagerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Managers\SmsNotificationManager::class;
    }
}