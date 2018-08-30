<?php

namespace App\Http\Services;

use App\Models\User;
use App\Enums\Messages;

class UserService
{
	public static function index() {
        $name = request()->login_name;
        $role = request()->role;
        
        $users = User::on();
        if (isset($name)) {
            $users->where(function ($query) use ($name) {
                $query->where('firstname', 'like', '%' . $name . '%');
                $query->orWhere('lastname', 'like', '%' . $name . '%');
                $query->orWhere('login_name', 'like', '%' . $name . '%');
            });
        }
        if (isset($role)) {
            $users->where('role', $role);
        }

        return $users->get();
	}

	public static function getUserEdit() {
        return User::find(request()->id);
	}

	public static function editUser() {
        $data = [
            'firstname' => request()->firstname,
            'lastname' => request()->lastname,
            'role' => request()->role
        ];
        if (request()->password) {
            $data['password'] = request()->password;
        }
        // User::where('id', request()->id)
        User::find(request()->id)->update($data);
        session()->flash('msg',Messages::EDIT_SUCCESS);
	}

	public static function destroy() {
        User::find(request()->id)->delete();
        session()->flash('msg',Messages::DELETE_SUCCESS);
	}

    public static function confirmUserDelete() {
        return User::select(['id','login_name'])->where('id', request()->id)->first();
    }

    public static function postAdd() {
        User::create([
            'firstname' => request()->firstname,
            'lastname' => request()->lastname,
            'login_name' => request()->login_name,
            'password' => request()->password,
            'role' => request()->role,
        ]);
        session()->flash('msg',Messages::ADD_SUCCESS);
    }
}