<?php

namespace App\Http\Controllers\Api;

use App\Consts\MentorConst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Mentor;
use \Symfony\Component\HttpFoundation\Response;

class MentorLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard(MentorConst::GUARD)->attempt($credentials)) {
            $user = Mentor::whereEmail($request->email)->first();

            $user->tokens()->delete();
            $token = $user->createToken("login:user{$user->id}")->plainTextToken;

            return response()->json(['token' => $token], Response::HTTP_OK);
        }

        return response()->json('Mentor Not Found.', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
