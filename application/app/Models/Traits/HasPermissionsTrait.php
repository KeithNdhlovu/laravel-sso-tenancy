<?php

namespace App\Models\Traits;

use App\Models\Role;
use App\Services\Auth\CachedRolesAndPermissions;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissionsTrait
{
    /**
     * Assign the given roles to the User.
     *
     * @param array $roleIds
     * @return self
     */
    public function giveRoles(array $roleIds)
    {
        $this->roles()->sync($roleIds);
        return $this;
    }

    /**
     * Get all of the roles for the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id');
    }
    
    /**
     * Check if the user has AT LEAST one of the roles.
     *
     * @param array<string> $roleIds
     * @return bool
     */
    public function hasRoles(array $roleIds)
    {
        if (empty($roleIds)) {
            return false;
        }

        $foundRoles = $this->roles()
            ->wherePivotIn('role_id', $roleIds)
            ->get();

        return $foundRoles->count() > 0;
    }
   
    /**
     * Check if the user has AT LEAST one of the permissions.
     *
     * @param array<string> $permissionIds
     * @return bool
     */
    public function hasPermission(array $permissionIds)
    {
        if (empty($permissionIds)) {
            return false;
        }
        
        $permissions = $this->roles
            ->map(fn(Role $role) => CachedRolesAndPermissions::getPermissionIdsForRoleId($role->id))
            ->flatten(1)
            ->unique()
            ->toArray();

        return sizeof(array_intersect($permissionIds, $permissions)) > 0;
    }
}
