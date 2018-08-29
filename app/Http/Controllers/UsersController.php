<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\EditUser;
use App\Http\Requests\RegisterUser;
use App\Http\Service\UserService;

class UsersController extends Controller
{

    public function __construct()
    {
        $users = User::select('role')->groupby('role')->get();
        view()->share('userss',$users);
    }

    public function getAdd() {
        return view('users.create');
    }

    public function confirmAdd(RegisterUser $request) {
        return view('users.createconfirm', ['user' => $request->all()]);
    }

    public function postAdd(Request $request) {
        $users = UserService::postAdd($request);
        session()->flash('msg','You have been created user successful');
        
        return redirect("/user");

    }

    public function index(Request $request) {
        $users = UserService::index($request);
        return view('users.index', compact('users'));
    }

    public function confirmUserDelete(Request $request) {
        $user = UserService::confirmUserDelete($request);
        return view('users.deleteconfirm', ['user' => $user]);
    }

    public function destroy(Request $request) {
        User::destroy($request->id);
        session()->flash('msg','You have been delete successful');
        return redirect("/user");
    }

    public function getUserEdit(Request $request) {
        $user = UserService::getUserEdit($request);
        return view('users.edit', ['user' => $user]);
    }

    public function confirmEditUser(EditUser $request) {
        return view('users.editconfirm', ['user' => $request->all()]);
    }

    public function editUser(Request $request) {
        UserService::editUser($request);
        session()->flash('msg','You have been edit successful');
        
        return redirect("/user");

    }

}
