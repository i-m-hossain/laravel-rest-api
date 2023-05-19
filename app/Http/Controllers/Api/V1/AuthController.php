<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(RegisterRequest $request)
    {
        $formData = $request->all();
        $formData['password'] = bcrypt($formData["password"]);
        $user = User::create($formData);
        $token = $user->createToken('myAppToken')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            "email"=> "required | string",
            "password"=> "required | string"
        ]);

        $user = User::where('email', $fields["email"])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return ["msg"=> "bad credentials!"];
        }
        $token= $user->createToken('myAppToken')-> plainTextToken;
        return ['user'=> $user, 'token'=> $token];
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'msg'=> 'logged out'
        ];
    }
}
