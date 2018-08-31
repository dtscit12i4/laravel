<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUser;
use App\Http\Requests\RegisterUser;
use App\Http\Services\UserService;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        // middleware
    }

    /**
     * user index page
     * @return all user
     */
    public function index()
    {
        $users = UserService::index();

        return view('users.index', compact('users'));
    }

    /**
     * add user page
     */
    public function getAdd()
    {
        return view('users.create');
    }

    /**
     * confirm add user page
     */
    public function confirmAdd(RegisterUser $request)
    {

        return view('users.createconfirm', ['user' => $request->all()]);
    }

    /**
     * add new user to DB
     */
    public function postAdd()
    {
        UserService::postAdd();

        return redirect(route('user.index'));
    }

    /**
     * get view edit user form
     */
    public function getUserEdit()
    {
        $user = UserService::getUserEdit();
        return view('users.edit', ['user' => $user]);
    }

    /**
     * confirm edit user
     */
    public function confirmEditUser(EditUser $request)
    {
        return view('users.editconfirm', ['user' => $request->all()]);
    }

    /**
     * apply edit user to DB
     */
    public function editUser()
    {
        UserService::editUser();

        return redirect(route('user.index'));
    }

    /**
     * confirm delete user
     */
    public function confirmUserDelete()
    {
        $user = UserService::confirmUserDelete();

        return view('users.deleteconfirm', ['user' => $user]);
    }

    /**
     * apply delete user to DB
     */
    public function destroy()
    {
        UserService::destroy();
        return redirect(route('user.index'));
    }
}