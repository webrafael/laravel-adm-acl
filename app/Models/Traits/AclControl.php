<?php namespace App\Models\Traits;

use App\Models\Scopes\AclControlScope;

trait AclControl
{
    protected static function bootAclControl()
    {
        static::addGlobalScope(new AclControlScope());
    }
}