<?php

namespace App\Http\Controllers;
use App\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function index() {
        $users = AdminUser::all();
        return view('admin.users.index', compact('users'));
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
        $sql='';
        $tukhoa = $request->tukhoa;
        $roles = $request->roles;
        if (isset($tukhoa)) {
            $sql .= " where login_name = '".$tukhoa."'";
        }
        if (isset($roles)) {
            if ($sql=='') {
                $sql .= " where role = ".$roles;
            }
            else {
                $sql .= " and role = ".$roles;
            }
        }
        $sql = "select * from admin_users".$sql;
        $result = DB::select($sql);
        return view('admin.users.result', compact('result'));
    }

    public function edit($id) {
        $users = AdminUser::find($id);
        return view('admin.users.edit', ['users' => $users]);
    }

    public function update(Request $request, $id) {
        $user = AdminUser::find($id);
        // Validate the user
        $request->validate([
           'firstname' => 'required',
           'lastname' => 'required',
        ]);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->role = $request->role;
        if ($request->password) {
            $request->validate([
                'password' => 'required|confirmed',
            ]);
            $user->password = bcrypt($request->password);
        }
        // Save the data
        $user->save();

        // Sign the user in
        // auth()->login($user);

        // Redirect to
        return redirect('/admin');

    }
}
