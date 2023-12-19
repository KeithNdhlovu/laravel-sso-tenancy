<?php

namespace Database\Seeders;

use App\Enums\SystemPermissions;
use App\Enums\SystemRoles;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // The default roles with their permissions
        $roles = collect(SystemRoles::cases());

        foreach ($roles as $roleObj) {
            /** @var \App\Models\Role */
            $role = Role::firstOrCreate([
                'id' => $roleObj->value,
                'description' => $roleObj->description(),
            ]);

            /** @var \App\Models\Permission[] */
            $createdPermissions = [];

            foreach ($roleObj->permissions() as $permissionObj) {
                /** @var \App\Models\Permission */
                $permission = Permission::firstOrCreate([
                    'id' => $permissionObj->value,
                    'description' => $permissionObj->description(),
                ]);

                $createdPermissions[] = $permission->id;
            }

            $role->permissions()->sync($createdPermissions);
        }
    }
}
