<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Repository\users\userRepo;
use http\Client\Curl\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    public function store(Request $request, userRepo $repo)
    {
        $users = $repo->getname($request->name);
        if ($users && Hash::check($request->password , $users->password)) {
            $token = $users->createToken($users->name)->plainTextToken;
            return response()->json(['token' => $token, 'user' => $users]);
        }else {
            return response()->json(['message' => 'Password does not match'], 401);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(["good by"], 200);
    }
}
