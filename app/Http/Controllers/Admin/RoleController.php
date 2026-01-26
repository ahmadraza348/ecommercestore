<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Services\Admin\RoleService;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
     protected RoleService $roleService;

      public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

 public function all_roles()
    {
        return view('backend.roles_permissions.roles', [
            'roles' => Role::latest()->get()
        ]);
    }

 public function add_roles(RoleStoreRequest $request)
    {
        $this->roleService->createRole($request->validated());

        toastr()->success('Role created successfully');
        return redirect()->route('admin.roles.index');
    }
  public function edit_roles(Role $role)
    {
        return view('backend.roles_permissions.roles', [
            'roles'       => Role::latest()->get(),
            'editingRole' => $role,
        ]);
    }

    public function update_roles(RoleStoreRequest $request, Role $role)
    {
        $this->roleService->updateRole($role, $request->validated());

        toastr()->success('Role updated successfully');
        return redirect()->route('admin.roles.index');
    }

    public function delete_roles(Role $role)
    {
        $this->roleService->deleteRole($role);

        toastr()->success('Role deleted successfully');
        return redirect()->route('admin.roles.index');
    }
}
