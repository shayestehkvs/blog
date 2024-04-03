<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.master');
    }
    public function redirect()
    {
        $user_type = Auth()->user()->userType;
        if($user_type == '1') {
            return view('admin.index');
        } else {
            return view('home.master');
        }
    }
}
