<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function all_roles()
    {
       $data['role'] = Role::all();
        return view('backend.roles_permissions.roles', $data);   
    }
}
