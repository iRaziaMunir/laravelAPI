<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $token = auth('jwt')->login($user);

        return response()->json([

            'status'=>'success',
            'success'=>'User Created Successfully!',
            'user'=>$user,
            'authorization'=>[
                'token'=>Auth::refresh(),
                'type'=>'bearer',
            ]
        ]);
        return $this->createNewToken($token);
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

            return response()->json(['error' => 'Unauthorized!']);
        }

        return $this->createNewToken($token);
    }
    protected function createNewToken($token){
        $user = auth('jwt')->user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth('jwt')->factory()->getTTL() * 60,
            'user' => $user,
        ]);

    }
    public function profile(){

        $profile = auth()->user();
        return response()->json([
            "status" => 1,
            "message" => "User profile data",
            'profile' => $profile,
        ]);

    }

    // public function refresh()
    // {
    //     $newToken = JWTAuth::refresh();  // Refresh the JWT token
    //     return response()->json([
    //         'status'=> 'success',
    //         'user'=> Auth::guard('api')->user(),
    //         'authorization'=>[
    //             'token'=>$newToken,
    //             'type'=>'bearer',
    //         ]
    //     ]);
    // }

    public function refresh()
{
    try {
        if (! $token = JWTAuth::getToken()) {
            return response()->json(['error' => 'Token not provided'], 400);
        }

        $newToken = JWTAuth::refresh($token);

        return response()->json([
            'status' => 'success',
            'user' => Auth::guard('api')->user(),
            'authorization' => [
                'token' => $newToken,
                'type' => 'bearer',
            ]
        ]);
    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    public function logout()
    {
        Auth::guard('api')->logout();  // Specify the guard to logout from
        return response()->json([
                    "status" => 1,
                    "message" => "User logged out"
                ]);
    }
}
