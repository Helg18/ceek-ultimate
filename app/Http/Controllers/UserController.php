<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;

use Auth;
use Sellout\User;
use Sellout\Token;
use Sellout\Avatar;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // protected $eagerLoads = ['profileImage', 'avatar', 'images'];
    protected $eagerLoads = [];

    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        $avatar = Avatar::generate($user);
        $token = Token::generate($user, $request->header('deviceid'));
        return response()->json(['user' => $user->load('token', 'avatar')]);
    }
    public function update(UserUpdateRequest $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        return response()->json(['user' => $user->load($this->eagerLoads)]);
    }
}
