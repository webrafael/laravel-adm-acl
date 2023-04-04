<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        if (Schema::hasTable('permissions')) {
            $permissions = Permission::with('roles')->get();

            foreach ($permissions as $permission) {
                Gate::define("{$permission->name}-create", function (User $user) use ($permission) {
                    return $user->verifyPermission("create", $permission->name);
                });
                Gate::define("{$permission->name}-read", function (User $user) use ($permission) {
                    return $user->verifyPermission("read", $permission->name);
                });
                Gate::define("{$permission->name}-update", function (User $user) use ($permission) {
                    return $user->verifyPermission("update", $permission->name);
                });
                Gate::define("{$permission->name}-delete", function (User $user) use ($permission) {
                    return $user->verifyPermission("delete", $permission->name);
                });
            }
        }

        Gate::before(function (User $user): ?bool {
            return ($user->isSuperUser()) ? true : null;
        });
    }
}
