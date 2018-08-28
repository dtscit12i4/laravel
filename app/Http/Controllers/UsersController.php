<?php

namespace App\Http\Controllers;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Requests\EditUser;

class UsersController extends Controller
{

    public function index() {
        $users = AdminUser::all();
        return view('admin.users.index', compact('users'));
    }

    public function show($id) {
        $users = AdminUser::find($id);

        echo '<p>'.$users->login_name.'</p>';
    }

    public function getdata($id) {
        $user = AdminUser::find($id);

        return view('admin.users.edit1', ['user' => $user]);
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

    public function store(Request $request) {
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

    public function edit($id) {
        $users = AdminUser::find($id);
        return view('admin.users.edit', ['users' => $users]);
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
}
