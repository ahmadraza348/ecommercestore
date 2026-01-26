<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
}
