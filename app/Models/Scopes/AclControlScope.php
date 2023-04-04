<?php

namespace App\Models\Scopes;

use App\AclControl\AclControlFacade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class AclControlScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $user = AclControlFacade::getAclControl();

        if ($user->id !== 1) {
            if ($user->id !== 1 && $user->id !== 2) {
                $builder->where('id', '<>', 1)->where('id', '<>', 2);
            } else {
                $builder->where('id', '<>', 1);
            }
        }
    }

}
