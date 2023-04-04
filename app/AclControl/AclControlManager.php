<?php namespace App\AclControl;

use App\Models\User;

class AclControlManager
{
    private User $acl;

    /**
     * @param User|null $acl
     * @return void
     */
    public function setAclControl(?User $acl): void
    {
        $this->acl = $acl;
    }

    /**
     * @return User|null
     */
    public function getAclControl(): ?User
    {
        return $this->acl;
    }
}