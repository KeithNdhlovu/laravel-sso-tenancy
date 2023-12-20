<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\CachedRolesAndPermissions;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Constructor.
     *
     * @param \App\Services\Auth\CachedRolesAndPermissions $cachedRolesAndPermissions
     */
    public function __construct(
        private CachedRolesAndPermissions $cachedRolesAndPermissions,
    ) {}

    public function index(Request $request)
    {
        /** @var \App\Models\User */
        $user = auth()->user();
        // $user->roles()->create(['role_id' => SystemRoles::RoleSystemHod->value]);
        // tenant()->run(fn() => $user->roles()->create(['role_id' => SystemRoles::RoleSystemAdmin->value]))
        dd(tenant('id'));
        dd($user);
        $user->load(['roles.permissions']);

        // dd($user->hasRoles([SystemRoles::RoleSystemAdmin->value]));

        $permissionIds = $this->cachedRolesAndPermissions->getPermissionIdsForUser($user);

        dd($permissionIds);
    }
}
