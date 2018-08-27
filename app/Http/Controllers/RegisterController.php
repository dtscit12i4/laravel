<?php
namespace App\Http\Controllers;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;

class RegisterController extends Controller
{
    public function index() {
        return view('admin.users.create');
    }

    public function store(RegisterUser $request) {

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
        return redirect('/admin');

    }
}

?>