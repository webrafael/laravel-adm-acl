<?php namespace App\Models;

use App\Models\User;
use App\Models\Traits\AclControl;

class AclUser extends User
{
    protected $table = 'users';

    use AclControl;
}