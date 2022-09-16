<?php

namespace App\Http\Controllers;

use App\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    public function register(Request $request)
	{
		$validatedData = $request->validate([
			'name' => 'required|max:55',
			'email' => 'email|required|unique:users',
			'password' => 'required|confirmed'
		]);

		$validatedData['password'] = Hash::make($request->password);

		if (!$validatedData) {
			return response(['Data not saved'], 400);
		}else{
			$createuser = User::create($validatedData);
			if ($createuser) {
				return response(['status' => 'user created'], 201);
			}else{
				return response(['Data not saved'], 400);
			}
		}	 
	} 

	public function login(Request $request)
	{
		$loginData = $request->validate([
			'email' => 'email|required',
			'password' => 'required'
		]);

		if (!auth()->attempt($loginData)) {
			return response(['message' => 'This User does not exist, check your details'], 400);
		}

		$accessToken = auth()->user()->createToken('authToken')->accessToken;
		return response(['user' => auth()->user(), 'access_token' => $accessToken]);
	}
}
