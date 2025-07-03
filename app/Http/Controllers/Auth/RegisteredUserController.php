<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\AuthenticationResource;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Validation\Rules;
use Symfony\Component\HttpFoundation\Response;

class RegisteredUserController extends Controller
{
    public function store(RegisterRequest $request): Response
    {
        $data = $request->validated();

        $user = User::create($data);

        event(new Registered($user));

        $token = $user->createToken('api-token')->plainTextToken;

        $user->token = $token;

        return response()->json(new AuthenticationResource($user), 200);
    }
}
