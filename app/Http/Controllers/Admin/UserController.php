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
        $data = $request->validate([
           'name' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
           'phone' => ['string','max:255'],
           'address' => ['string', 'max:255'],
           'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create($data);
        if($request->has('verify')) {
            $user->markEmailAsVerified();
        }
        return redirect(route('all-users'))->with('status', 'Data saved');
//        $user = new User();
//        $user->name = $request->name;
//        $user->email = $request->email;
//        $user->phone = $request->phone;
//        $user->password = $request->password ;
//        $user->address = $request->address ;
//        $user->save();
//        session()->flash('statuscode', 'success');
//        return redirect('all-categories')->with('status', 'Data saved');
    }
    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.users.edit-user')->with('user', $user);
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
