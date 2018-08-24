<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AdminUser;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function index() {
        return view('admin.login');
    }

    public function store(Request $request) {

        // Validate the user
        $request->validate([
            'login_name' => 'required',
            'password' => 'required'
        ]);

        // Log the user In
        $credentials = $request->only('login_name','password');

        if (! Auth::guard('admin')->attempt($credentials)) {
            return back()->withErrors([
                'message' => 'Wrong credentials please try again'
            ]);
        }

        // Session message
        session()->flash('msg','You have been logged in');

        return redirect('/admin');

    }

    public function logout() {
        auth()->guard('admin')->logout();

        session()->flash('msg','You have been logged out');

        return redirect('/admin/login');
    }

}