<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;
use App\Http\Requests\FormUser;
use App\Http\Requests\EditUser;
use App\Http\Requests\RegisterUser;

class AdminUserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:admin')->except(['logout','getRegister','postRegister','getUser','getLoginName','destroy','search','edit','update']);
    }

    public function index() {
        return view('admin.login');
    }

    public function getRegister() {
        // return view('admin.users.create');
        return view('admin.users.create1');
    }

    public function postRegister(RegisterUser $request) {

        // Save the data
        $user = AdminUser::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'login_name' => $request->login_name,
            'password' => bcrypt($request->password),
            'role' => $request->role,

        ]);
        session()->flash('msg','You have been created user successful');
        // Sign the user in
        // auth()->login($user);

        // Redirect to
        // return redirect('/admin');
        return 1;

    }

    public function getUser() {
        $users = AdminUser::all();
        return view('admin.users.index', compact('users'));
    }

    public function getLoginName($id) {
        $users = AdminUser::find($id);

        echo '<p>'.$users->login_name.'</p>';
    }

    public function destroy($id) {
        $users = AdminUser::all();
        // Find the user
        AdminUser::destroy($id);

        // Return array back to user details page
        if ($users->count()) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }

    }

    public function search(Request $request) {
        $tukhoa = $request->tukhoa;
        $roles = $request->roles;
        $users = AdminUser::on();
        $condition = [];
        if (isset($tukhoa)) {
            $condition[] = ['login_name','like','%'.$tukhoa.'%'];
        }
        if (isset($roles)) {
            $condition[] = ['role','=',$roles];
        }
        $result = $users->where($condition)->get();
        return view('admin.users.result', compact('result'));
    }

    public function store(FormUser $request) {

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

    public function edit($id) {
        $user = AdminUser::find($id);
        return view('admin.users.edit1', ['user' => $user]);
    }

    public function update(EditUser $request, $id) {
        $user = AdminUser::find($id);
        // Validate the user
        // $request->validate([
        //    'firstname' => 'required',
        //    'lastname' => 'required',
        // ]);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->role = $request->role;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        // Save the data
        $user->save();
        session()->flash('msg','You have been edit successful');
        // Sign the user in
        // auth()->login($user);

        // Redirect to
        return 1;

    }

    public function logout() {
        auth()->guard('admin')->logout();

        session()->flash('msg','You have been logged out');

        return redirect('/admin/login');
    }

}
