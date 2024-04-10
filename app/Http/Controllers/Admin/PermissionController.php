<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function allPermission()
    {
        $permissions = Permission::all();
        return view('admin.permissions.all-permission')->with('permissions', $permissions);
    }
    public function createPermission()
    {
        return view('admin.permissions.create-permission');
    }
    public function storePermission(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'label' => ['required', 'string', 'max:255'],
        ]);
        $user = Permission::create($data);
        return redirect(route('all-permissions'))->with('status', 'Data saved');
    }
    public function editPermission($id)
    {
        $permission = Permission::find($id);
        return view('admin.permissions.edit-permission')->with('permission', $permission);
    }
    public function updatePermission(Request $request, $id)
    {
        $permission = Permission::find($id);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'label' => ['nullable', 'string', 'max:255'],
        ]);

        $permission->update($data);
        Session()->flash('statusCode', 'success');
        return redirect(route('all-permissions'))->with('status', 'Data saved');
    }
    public function deletePermission($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return response()->json(['status'=> 'Permission deleted successfully']);
    }
}
