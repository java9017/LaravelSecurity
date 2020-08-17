<?php

namespace App\Traits;

trait UserTrait 
{
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimesTamps();
    }

    public function havePermission($permission) 
    {   
        foreach ($this->roles as $role) {
            if ($role['full-access'] == 'yes') {
                return true;
            }
            
            // Extraction of permissions on roles
            $userPerm = array_column($role->permissions->toArray(), 'slug');
            if (array_intersect($userPerm, is_array($permission) ?: [$permission])) {
                return true;
            }
        }
        
        return false;
    }
}