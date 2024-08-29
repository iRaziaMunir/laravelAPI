<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(), [

            'name'=>'required|string|min:5|max:100',
            'email'=>'required|string|email|max:100|unique:users',
            'password'=>'required|string|min:8|confirmed',
        ]);

        if($validator->fails()){

            return response()->json($validator->errors(), 400);
        }
        $user = User::create([
    
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
        ]);

        $token = auth()->login($user);

        return response()->json([

            'status'=>'success',
            'success'=>'User Created Successfully!',
            'user'=>$user,
            'authorization'=>
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]
        ]);
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [

            'email'=>'required|string|email',
            'password'=>'required|string',
        ]);

        if($validator->fails()){

            return response()->json($validator->errors(), 400);
        }

        if(!$token = auth()->attempt($validator->validated())){

            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return $this->respondWithToken($token);
    }
    public function profile(){
        return response()->json([
            "status" => "success",
            "message" => "User profile data",
            "user" => auth()->user(),
        ]);

    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]
        );
    }
}
