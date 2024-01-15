<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ConfirmationPasswordRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repository\users\userRepo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|max:12|min:10',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken($user->name)->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function updatedPassword(ConfirmationPasswordRequest $request , userRepo $repo): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        $users = $repo->getFindId(auth()->user()->id);
        if ($users && Hash::check($request->old_password , $users->password)) {
            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);
            return response()->json(['status' => 'success','message' => 'رمز شما به درستی تعقیر کرد '] , 200);
        }else {
            return response()->json(['status' => 'error' , 'message' => 'پسورد وارد شده صحیح نمیباشد '], 401);
        }

    }
}
