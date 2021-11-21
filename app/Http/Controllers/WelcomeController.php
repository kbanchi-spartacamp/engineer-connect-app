<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Consts\UserConst;
use App\Consts\MentorConst;

class WelcomeController extends Controller
{
    public function index()
    {
        if (Auth::guard(UserConst::GUARD)->check()) {
            return redirect()->route('mentor_schedules.index');
        }

        if (Auth::guard(MentorConst::GUARD)->check()) {
            return redirect()->route('reservations.index');
        }

        return view('welcome');
    }
}
