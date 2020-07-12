<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\UserResource;

class IndexController extends BaseController
{
    public function welcome()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $data = $request->all();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'isAdmin' => 1])) {
            return response()->json('Вы успешно авторизовались', 200);
        } else {
            return response()->json('Логин или пароль не правильно', 401);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function getUsers()
    {
        $users = User::where(['isAdmin' => 0])->orderBy('id', 'DESC')->get();
        UserResource::withoutWrapping();
        return UserResource::collection($users);
    }
}
