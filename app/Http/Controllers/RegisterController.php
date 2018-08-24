<?php
namespace App\Http\Controllers;
use App\AdminUser;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('admin.users.create');
    }

    public function store(Request $request) {

        // Validate the user
        $request->validate([
           'firstname' => 'required',
           'lastname' => 'required',
            'login_name' => 'required',
            'password' => 'required|confirmed',
        ]);

        // Save the data
        $user = AdminUser::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'login_name' => $request->login_name,
            'password' => bcrypt($request->password),
            'role' => $request->role,

        ]);

        // Sign the user in
        // auth()->login($user);

        // Redirect to
        return redirect('/admin');

    }
}

?>