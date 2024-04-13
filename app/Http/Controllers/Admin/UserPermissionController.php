<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function createUserPermission($id)
    {
        $user = User::find($id);
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.users.user-permission', compact('user', 'permissions', 'roles'));
    }
    public function storeUserPermission(Request $request, $id)
    {
        $user = User::find($id);
        $user->permissions()->sync($request->permissions);
        $user->roles()->sync($request->roles);

        session()->flash('statuscode', 'success');
        return redirect(route('all-users'))->with('status', 'Data saved');
    }
}
