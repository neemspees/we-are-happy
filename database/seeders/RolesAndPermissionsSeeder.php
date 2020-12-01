<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesPermissions =  config('roles');

        foreach ($rolesPermissions as $roleName => $permissions) {
            $role = Role::query()->firstOrCreate([
                'name' => $roleName
            ]);

            foreach ($permissions as $permissionName) {
                $permission = Permission::query()->firstOrCreate([
                    'name' => $permissionName
                ]);

                if ($role->hasPermissionTo($permission)) {
                    continue;
                }

                $role->permissions()->save($permission);
            }
        }
    }
}
