<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\EmailVeiryNotification;
use Carbon\Carbon;

class AuthController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','signup','genarateEmailVerificationCode','verifyAccount']]);
    }
 
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function signup(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
        ]);

        $user = User::create($request->all());
        $this->genarateEmailVerificationCode($user->id);
        return $this->login($request);
    }

    public function genarateEmailVerificationCode($id){

        $user = User::find($id);
        $code = rand(10000,99999);
        if($user->userVerify){
            $user->userVerify->delete();
        }
        $user->userVerify()->create([
            'verification_code' => $code,
        ]);

        $user->notify(new EmailVeiryNotification($code,$user->name));
        
        
    }

    public function verifyAccount(Request $request){

        $request->validate([
            'verification_code' => 'required',
        ]);

        $id = auth()->id();
        $user = User::find($id);
        $verification_code = $user->userVerify()->first()->verification_code;
        $new_verification_code = $request->verification_code;

        if($verification_code == $new_verification_code){
            $email_verified_at = Carbon::now();
            $user->update([
                'email_verified_at' => $email_verified_at,
            ]);  
            return $email_verified_at;

        }else{
            return response()->json([
                'code' => 401,
                'message' => 'Invalid verification code !',
            ],401);
        }
        
    }
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    
    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

        public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

   
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}