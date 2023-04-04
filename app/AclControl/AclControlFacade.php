<?php namespace App\AclControl;

use App\AclControl\AclControlManager;
use Illuminate\Support\Facades\Facade;

class AclControlFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return AclControlManager::class;
    }
}