<?php

namespace App\Services\Admin;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function createRole(array $data): Role
    {
        return DB::transaction(function () use ($data) {
            $role = Role::create($data);
            return $role;
        });
    }
}
