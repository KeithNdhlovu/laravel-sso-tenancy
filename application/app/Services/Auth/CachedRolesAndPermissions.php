<?php

namespace App\Services\Auth;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;

class CachedRolesAndPermissions
{
    /**
     * Cache tag associated with the cache keys used in this class for easy flushing of related key.
     *
     * @var string
     */
    public const CACHE_TAG_ROLES_AND_PERMISSIONS = 'application-roles-tag';

    /**
     * Get role IDs attached to a specific permission ID. These can be cached as they don't change often. The cache is cleared on each deploy.
     *
     * @param string $permissionId
     * @return array<string> Array of role IDs
     */
    public function getRoleIdsForPermissionId(string $permissionId) : array
    {
        $cacheKey = "application-rls-{$permissionId}";

        $roleIds = cache()->tags([self::CACHE_TAG_ROLES_AND_PERMISSIONS])->get($cacheKey);

        if ($roleIds) {
            return $roleIds; // Found in cache
        }

        // Not found in cache, hit DB and store in cache for next round
        $roleIds = Role::whereHas('permissions', function ($q) use ($permissionId) {
            $q->where('permissions.id', $permissionId);
        })->pluck('id')
          ->toArray();

        cache()->tags([self::CACHE_TAG_ROLES_AND_PERMISSIONS])->put($cacheKey, $roleIds, now()->addDay());

        return $roleIds;
    }

    /**
     * Get permission IDs attached to a specific role ID. These can be cached as they don't change often. The cache is cleared on each deploy.
     *
     * @param string $roleId
     * @return array<string> Array of permission IDs
     */
    static function getPermissionIdsForRoleId(string $roleId) : array
    {
        $cacheKey = "application-rls-{$roleId}";

        $permissionIds = cache()->tags([self::CACHE_TAG_ROLES_AND_PERMISSIONS])->get($cacheKey);

        if ($permissionIds) {
            return $permissionIds; // Found in cache
        }

        // Not found in cache, hit DB and store in cache for next round
        $permissionIds = Permission::whereHas('roles', function ($q) use ($roleId) {
            $q->where('roles.id', $roleId);
        })->pluck('id')
          ->toArray();

        cache()->tags([self::CACHE_TAG_ROLES_AND_PERMISSIONS])->put($cacheKey, $permissionIds, now()->addDay());

        return $permissionIds;
    }

     /**
      * Get permission IDs attached to a specific user.
      *
      * @param \App\Models\User $user
      * @return array<string> Array of permission IDs
      */
    static function getPermissionIdsForUser(User $user) : array
    {
        $permissionIds = $user->roles
            ->map(fn(Role $role) => self::getPermissionIdsForRoleId($role->id))
            ->flatten(1)
            ->unique()
            ->toArray();

        return $permissionIds;
    }
}
