<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleService
{
    public function createRole(array $data): Role
    {
        return DB::transaction(function () use ($data) {
            $role = Role::create($data);
            return $role;
        });
    }

    public function updateRole(Role $role, array $data): Role
    {
        return DB::transaction(function () use ($role, $data) {
            $role->update($data);

            return $role;
        });
    }

    public function deleteRole(Role $role): void //using void as it does not return anything
    {
        DB::transaction(function () use ($role) {
            $role->delete();
        });
    }

    public function createPermission(array $data)
    {
        return DB::transaction(function () use ($data) {
            $permission = Permission::create($data);
            return $permission;
        });
    }

      public function updatePermission(Permission $permission, array $data): Permission
    {
        return DB::transaction(function () use ($permission, $data) {
            $permission->update($data);

            return $permission;
        });
    }

    public function deletePermission(Permission $permission): void //using void as it does not return anything
    {
        DB::transaction(function () use ($permission) {
            $permission->delete();
        });
    }
}
