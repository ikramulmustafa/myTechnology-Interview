<?php


namespace App\Services;


use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class UserService extends Service
{

    public function store(UserCreateRequest $request)
    {
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role_id' => $request['role_id'],
            'password' => Hash::make($request['password']),
        ]);

    }
    public function update(UserUpdateRequest $request,$user_id){
        return User::where('id',$user_id)->update([
            'name' => $request['name'],
            'role_id' => $request['role_id']]);
    }
}
