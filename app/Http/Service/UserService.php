<?php

namespace App\Http\Service;

use App\Models\User;

class UserService
{
	public static function index($request) {
        $condition = [];
        if (isset($request->login_name)) {
            $condition[] = ['login_name','like','%'.$request->login_name.'%'];
        }
        if (isset($request->role)) {
            $condition[] = ['role','=',$request->role];
        }

        $users = User::where($condition)->get();
        return $users;
	}

	public static function getUserEdit($request) {
        return User::find($request->id);
	}

	public static function editUser($request) {
        $user = User::find($request->id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->role = $request->role;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
	}

	public static function confirmUserDelete($request) {
        return User::select(['id','login_name'])->where('id', $request->id)->first();
	}

    public static function postAdd($request) {
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'login_name' => $request->login_name,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
    }
}