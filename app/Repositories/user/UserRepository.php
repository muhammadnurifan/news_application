<?php

namespace App\Repositories\user;

use App\Repositories\user\UserInterface;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use Carbon\Carbon;
use Validator;


class UserRepository implements UserInterface
{
    public function store($request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users'
        ]);

        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->role = 'User';
        $user->save();
        // dd($user);

        return $user;
    }
}
