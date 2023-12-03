<?php

namespace App\Http\Controllers\front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwofactorAuthController extends Controller
{
    public function index(){
        $user= Auth::user();
        return view('front.auth.two-factor-auth',compact('user'));
    }

}
