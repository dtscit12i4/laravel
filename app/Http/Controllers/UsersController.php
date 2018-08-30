<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\EditUser;
use App\Http\Requests\RegisterUser;
use App\Http\Services\UserService;

class UsersController extends Controller
{
    /**
     * Add User Module
     */
    public function __construct()
    {
        // middleware
    }
    // show add screen
    public function getAdd() {
        return view('users.create');
    }
    // show confirmation screen
    public function confirmAdd(RegisterUser $request) {

        return view('users.createconfirm', ['user' => $request->all()]);
    }
    // save
    public function postAdd() {
        UserService::postAdd();
        
        return redirect(route('user.index'));
    }
    // show all user
    public function index() {
        $users = UserService::index();

        return view('users.index', compact('users'));
    }
    // show screen confirm delete
    public function confirmUserDelete() {
        $user = UserService::confirmUserDelete();

        return view('users.deleteconfirm', ['user' => $user]);
    }
    // delete user
    public function destroy() {
        UserService::destroy();
        return redirect(route('user.index'));
    }
    // show screen edit user
    public function getUserEdit() {
        $user = UserService::getUserEdit();
        return view('users.edit', ['user' => $user]);
    }
    // show screen confirm edit
    public function confirmEditUser(EditUser $request) {
        return view('users.editconfirm', ['user' => $request->all()]);
    }
    // edit user
    public function editUser() {
        UserService::editUser();

        return redirect(route('user.index'));
    }

}
