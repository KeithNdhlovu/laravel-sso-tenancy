<?php

namespace App\Http\Controllers;

use App\Enums\SystemPermissions;
use App\Enums\SystemRoles;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Services\Auth\CachedRolesAndPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Constructor.
     *
     * @param \App\Services\Auth\CachedRolesAndPermissions $cachedRolesAndPermissions
     */
    public function __construct(
        private CachedRolesAndPermissions $cachedRolesAndPermissions,
    ) {}

    /**
     * Undocumented function.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function welcome(Request $request)
    {
        return view('welcome');
    }

    public function index(Request $request)
    {
        /** @var \App\Models\User */
        $user = auth()->user();
        // $user->roles()->create(['role_id' => SystemRoles::RoleSystemHod->value]);
        // tenant()->run(fn() => $user->roles()->create(['role_id' => SystemRoles::RoleSystemAdmin->value]))
        dd($user);
        $user->load(['roles.permissions']);

        // dd($user->hasPermission(['create_audits']));
        // dd($user->hasRoles([SystemRoles::RoleSystemAdmin->value]));

        $permissionIds = $this->cachedRolesAndPermissions->getPermissionIdsForUser($user);

        dd($permissionIds);
    }
}
