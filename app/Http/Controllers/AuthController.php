<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
Use DB;

class AuthController extends Controller
{
    //
/**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
         $validateData = $request->validate([
         'icno' => 'required',
         'password' => 'required',
         
         ]);

        $credentials = request(['icno','password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid credential!'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    
    public function register(Request $request){
           $request->validate([
                'email'=>'required|unique:users|max:255',
                'name'=>'required',
                'icno'=>'required|unique:users|max:16',
                'password'=>'required|min:6|confirmed',
                'roles'=>'required',
            

            ]);
            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['icno'] = $request->icno;
            $data['password'] = Hash::make($request->password);
            $data['roles'] = $request->roles;
            DB::table('users')->insert($data);

           
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'user_id' => auth()->user()->id,
            'icno' => auth()->user()->icno,
            'roles' => auth()->user()->roles,
            'current_team_id' => auth()->user()->current_team_id,   
        ]);
    }
    
   

}