<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function allRole()
    {
        $roles = Role::all();
        return view('admin.roles.all-roles')->with('roles', $roles);
    }
    public function createRole()
    {
        $permissions = Permission::all();
        return view('admin.roles.create-role')->with('permissions', $permissions);
    }
    public function storeRole(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'label' => ['required', 'string', 'max:255'],
            'permissions' => ['required', 'array'],
        ]);
        $role = Role::create($data);
        $role->permissions()->sync($data['permissions']);
        return redirect(route('all-roles'))->with('status', 'Data saved');
    }
    public function editRole($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
//        dd($role);
        return view('admin.roles.edit-role')->with('role', $role)->with('permissions', $permissions);
    }
    public function updateRole(Request $request, $id)
    {
        $role = Role::find($id);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'label' => ['nullable', 'string', 'max:255'],
            'permissions' => ['required', 'array'],
        ]);

        $role->update($data);
        $role->permissions()->sync($data['permissions']);
        Session()->flash('statusCode', 'success');
        return redirect(route('all-roles'))->with('status', 'Data saved');
    }
    public function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();
        return response()->json(['status'=> 'Role deleted successfully']);
    }
}
