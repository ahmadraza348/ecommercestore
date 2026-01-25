<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleStoreRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function all_roles()
    {
        $data['roles'] = Role::all();
        return view('backend.roles_permissions.roles', $data);
    }

    public function add_roles(Role $role, RoleStoreRequest $request)
    {
        $role->create($request->validated());
        toastr()->success('Role created successfully');
        return redirect()->route('admin.roles.index');
    }

    public function edit_roles(Role $role)
    {
        $roles = Role::latest()->get();

        return view('backend.roles_permissions.roles', [
            'roles' => $roles,
            'editingRole' => $role,
        ]);
    }

    public function update_roles(RoleStoreRequest $request, Role $role)
    {
        $role->update($request->validated());
        toastr()->success('Role updated successfully');
        return redirect()->route('admin.roles.index');
    }
    public function delete_roles( Role $role)
    {
        $role->delete();
        toastr()->success('Role deleted successfully');
        return redirect()->route('admin.roles.index');
    }
}
