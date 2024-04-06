<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function allUser()
    {
        $users = User::all();
        return view('admin.users.all-users')->with('users', $users);
    }

    public function createUser()
    {
        return view('admin.users.create-user');
    }

    public function storeUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address ;
        $user->save();
        session()->flash('statuscode', 'success');
        return redirect('all-categories')->with('status', 'Data saved');
    }
    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.categories.edit-user')->with('user', $user);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->update();
        Session()->flash('statusCode', 'success');
        return redirect('all-users')->with('status', 'Data updated');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['status'=> 'User deleted successfully']);
    }
}
