<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Contracts\Services\AuthServiceInterface;

class AuthController extends Controller
{
    /**
     * authentication service
     */
    private $authService;

    /**
     * Constructor for auth controller
     *
     * @param \App\Contracts\Services\AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Email or Password is incorrect.'], 401);
        }

        $user = $this->authService->findUserByEmail($request->email);

        $token = $user->createToken('api_token')->plainTextToken;

        $data = [
            'token' => $token, 
            'name' => $user->name, 
            'email' => $user->email
        ];
        
        return response()->json($data, 200);
    }

    /**
     * Register user
     *
     * @param \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $this->authService->register($request->all());

        return response()->json(['message' => 'User registered successfully'], 200);
    }

    /**
     * Logout user
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logout successfully'], 200);
    }
}
