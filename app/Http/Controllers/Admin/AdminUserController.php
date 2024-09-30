<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function show()
    {
        $data['adminusers'] = Admin::latest()->get();
        return view('backend.adminuser.show', $data);
    }
    public function add()
    {
        return view('backend.adminuser.add');
    }
    public function store(request $request)
    {
        $request->validate([
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'username' => ['required', 'unique:admins', 'max:30'],
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        $admin = new Admin;
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->status = $request->status;
        $admin->save();
        toastr()->success('Admin User registered Successfully');
        return redirect()->route('admin.user.show');
    }

 

    public function edit($id)
    {
        $data['admin_data'] = Admin::findOrFail($id);
        return view('backend.adminuser.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'username' => 'required|max:30|unique:admins,username,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
        ]);
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
            ]);
        }

        $admin = Admin::find($id);
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->status = $request->status;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();
        toastr()->success( 'Admin User updated Successfully');
        return redirect()->route('admin.user.show');
    }

    public function delete($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        toastr()->success('Admin User Deleted Successfully');
        return redirect()->route('admin.user.show');
    }

    public function profile(){
        $user = auth()->guard('admin')->user(); 
        return view('backend.adminuser.profile', compact('user'));
        
        return view('backend.adminuser.profile');
    }
    public function profile_update(Request $request, $id)
{
    $request->validate([
        'first_name' => 'required|max:30',
        'last_name' => 'required|max:30',
        'username' => 'required|max:30|unique:users,username,' . $id,
        'email' => 'required|email|unique:users,email,' . $id,
        'phone' => 'nullable|digits_between:10,15',
        'gender' => 'nullable|string|max:10',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    $user = User::findOrFail($id);
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->gender = $request->gender;

    if ($request->filled('password')) {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('profile_image')) {
        $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image = $imagePath;
    }

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

}
