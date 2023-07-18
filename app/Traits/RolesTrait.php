<?php

namespace App\Traits;

Trait RolesTrait
{
    public static function hasRoles($roles, $userRoles): bool
    {
        $found = false;
        foreach ($roles as $role) {
            if(in_array($role, $userRoles)){
                $found = true;
            }
        }
        return $found;
    }
}
