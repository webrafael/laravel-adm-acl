<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'create',
        'read',
        'update',
        'delete',
        'active'
    ];

    /**
     * The roles that belong to the permission.
     *
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'role_permissions')->withTimestamps();
    }
}
