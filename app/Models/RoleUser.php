<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleUser extends Model
{
    use HasFactory;

    public $table = 'role_user';

    protected $dates = [
        'expires_at'
    ];

    /**
     * Return true if role is still valid.
     *
     * @return bool
     */
    public function isActive()
    {
        return Carbon::now()->lt($this->expires_at);
    }
}
