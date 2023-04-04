<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\UuidGenerator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, UuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function verifyPermission($habilityName, $component)
    {
        // pega todos os cargos
        $roles = $this->roles()->get();

        foreach ($roles ?? [] as $role) { // percorre os cargos

            if ($role->active == 'yes') {
                // pega todas as permissões amarradas ao cargo
                $permissions = $role->permissions()->get();

                foreach ($permissions ?? [] as $permission) { // percorre as permissões

                    // checa se o nome da permissão corresponde ao nome da permissão recebida como parâmetro
                    if ($permission->name === $component) {

                        //valida a permissão
                        $hability = $permission->{$habilityName};

                        return $hability == "yes";
                    }
                }
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles, $ability = null)
    {
        if (is_array($roles) || is_object($roles)) {
            foreach ($roles as $role) {
                return $this->roles->contains('name', $role->name);
            }
        }
        return $this->roles->contains('name', $roles);
    }

    public function isSuperUser(): bool
    {
        if ($this->id == 1) {
            return true;
        }
        return false;
    }
}
