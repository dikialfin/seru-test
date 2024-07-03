<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // response data 
    // {
    //     "status": "success",
    //     "data": {
    //       "user": {
    //         "id": 1,
    //         "name": "John Doe",
    //         "email": "john.doe@example.com"
    //       }
    //     },
    //     "message": "User retrieved successfully.",
    //     "status_code": 200
    //      "errors" :{"username" : "username is required"}
    //   }

    public function register(Request $request)
    {

        $rules = [

            'username' => 'required|alpha_num|min:5|max:10|unique:users',
            'name' => 'required|string',
            'is_admin' => 'required|boolean',
            'password' => 'required|min:6',
        ];

        $validator = validator($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "bad request",
                "status_code" => 400,
                "errors" => $validator->errors()
            ], 400);
        }

        try {
            $user = new User();
            $user->name = $request->get('name');
            $user->is_admin = $request->get('is_admin');
            $user->username = $request->get('username');
            $user->password = $request->get('password');
            $user->save();

            return response()->json([
                "status" => "success",
                "data" => [],
                "message" => "register success",
                "status_code" => 201,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "internal server error",
                "status_code" => 500,
                "errors" => ["message" => "An error occurred while registering"]
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $rules = [

            'username' => 'required',
            'password' => 'required',
        ];

        $validator = validator($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "bad request",
                "status_code" => 400,
                "errors" => $validator->errors()
            ], 400);
        }

        if (!Auth::attempt([
            "username" => $request->get("username"),
            "password" => $request->get("password"),
        ])) {
            return response()->json([
                "status" => "failed",
                "message" => "unauthorized",
                "status_code" => 401,
                "errors" => ["message" => "username or password invalid"]
            ], 401);
        }

        $userToken = '';

        if (auth()->user()->is_admin) {
            $userToken = auth()->user()->createToken('admin-token', ['view-data',"create-data",'edit-data', 'delete-data'])->plainTextToken;
        } else {
            $userToken = auth()->user()->createToken('user-token', ['view-data'])->plainTextToken;
        }

        
        return response()->json([
            "status" => "success",
            "data" => [
                "name" => auth()->user()->name,
                "username" => auth()->user()->username,
                "is_admin" => auth()->user()->is_admin,
                "token" => $userToken,
            ],
            "message" => "login success",
            "status_code" => 200,
        ], 200);

    }
}
