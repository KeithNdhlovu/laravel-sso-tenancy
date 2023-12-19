<?php

namespace App\Policies;

use App\Services\Auth\CachedRolesAndPermissions;
use Illuminate\Support\Facades\Cache;

class CachedPolicy
{
    /**
     * Time to store the cached values (irrelevant for the array store).
     *
     * @var int
     */
    public const TIME = 60;

    /**
     * The cache instance to use for caching policies.
     *
     * @var Cache
     */
    protected $cache;

    /**
     * Class used to fetch roles and permission bindings in a cached manner. N.B not related to policies.
     *
     * @var \App\Services\Auth\CachedRolesAndPermissions
     */
    protected $cachedRolesAndPermissions;

    /**
     * Constructor.
     */
    public function __construct()
    {
        // We use array store to cache values for this request only
        $this->cache = Cache::store('array'); // @phpstan-ignore-line
        $this->cachedRolesAndPermissions = app()->make(CachedRolesAndPermissions::class);
    }

    /**
     * Remember.
     *
     * @param mixed $key
     * @param callable $callback
     * @return bool
     */
    public function remember($key, $callback)
    {
        return call_user_func_array([$this->cache, 'remember'], [$key, self::TIME, $callback]);
    }

    /**
     * Get role IDs attached to a specific permission ID.
     *
     * @param string $permissionId
     * @return array<string> Array of role IDs
     */
    public function getRoleIdsForPermissionId(string $permissionId) : array
    {
        return $this->cachedRolesAndPermissions->getRoleIdsForPermissionId($permissionId);
    }
    
    /**
     * Get permission IDs attached to a specific role ID.
     *
     * @param string $roleId
     * @return array<string> Array of role IDs
     */
    public function getPermissionIdsForRoleId(string $roleId) : array
    {
        return $this->cachedRolesAndPermissions->getPermissionIdsForRoleId($roleId);
    }
}
