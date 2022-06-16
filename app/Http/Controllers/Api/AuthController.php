<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
      $reqData = $request->all();
      $validator = Validator::make($reqData, [
        'name' => 'required|max:255',
        'email' => 'email|required|unique:users',
        'password' => 'required|confirmed'
      ]);

      if ($validator->fails()) {
        return response()->json([
          'errors' => $validator->errors()]
        , 422);
      }

      $reqData['password'] = Hash::make($reqData['password']);

      $user = User::create($reqData);

      return response()->json($reqData);
    }
}
