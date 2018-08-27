<?php

namespace App\Http\Controllers;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $users = AdminUser::find($id);
        $template = 
         '
            <div class="form-group">
                <label for="name">First Name:</label>
                <input type="text" name="firstname" placeholder="firstname" id="firstname" value="'.$users->firstname.'" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">Last Name:</label>
                <input type="text" name="lastname" placeholder="lastname" id="lastname" value="'.$users->lastname.'" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Login Name:</label>
                <input type="text" name="login_name" placeholder="login_name" id="login_name" value="'.$users->login_name.'" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" id="password_confirmation" class="form-control">
            </div>';

        if ( $users->role == 1) {
            $template .= '<div class="form-group">
                <label for="address">Role:</label>
                Admin <input type="radio" name="role" value="1" checked />
                NormalUser <input type="radio" name="role" value="0" />
                </div>
            ';
        }
        else {
            $template .= '<div class="form-group">
                <label for="address">Role:</label>
                Admin <input type="radio" name="role" value="1" />
                NormalUser <input type="radio" name="role" value="0" checked />
                </div>
            ';
        }

        echo $template;
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
        session()->flash('msg','You have been edit successful');
        // Sign the user in
        // auth()->login($user);

        // Redirect to
        return 1;

    }
}
