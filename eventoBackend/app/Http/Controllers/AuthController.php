<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','forgetPassword','resetPassword']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|max:255',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'), 
        ]);

        
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }
    public function login()
    {
            $validator = Validator::make(request()->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $credentials = request(['email', 'password']);

            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
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

        return response()->json(['message' => true]);
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
            'expires_in' => auth()->factory()->getTTL() * 300,
            'user' => auth()->user()->role_id
        ]);
    }
public function forgetPassword(){
    $validator = Validator::make(request()->all(), [
        'email' => 'required|string|email|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $data['email'] = request('email'); 
    dispatch(new SendEmailJob($data));

    $token = Hash::make(Str::random(60)); 

    $user = DB::table('users')->where('email', $data['email'])->first();

    if ($user) {
        $userId = $user->id;
        DB::table('users')->where('id', $userId)->update(['remember_token' => $token]);
        return response()->json(['reset_token' => $token]);
    }
    return response()->json(['error' => 'User not found'], 404);
}
public function resetPassword()
{
    $validator = Validator::make(request()->all(), [
        'password' => 'required|string|min:8', // Adjust min length as needed
        'reset_token' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = User::where('remember_token', request('reset_token'))->first();

    if ($user) {
        $hashedPassword = Hash::make(request('password'));
        $user->update(['password' => $hashedPassword]);
        return response()->json(['message' => 'Password updated successfully']);
    }

        return response()->json(['error' => 'User not found. Please try again.'], 404);
}

}
