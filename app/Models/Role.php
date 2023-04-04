<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, SoftDeletes, UuidGenerator;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'slug',
        'details',
        'active'
    ];

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'role_user')
            ->using(\App\Models\UserRole::class)
            ->withTimestamps()
            ->withPivot(['expires_at']);
    }

    /**
     * The permissions that belong to the role.
     *
     * @return BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'role_permissions')
            ->withTimestamps();
    }

    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }
}
