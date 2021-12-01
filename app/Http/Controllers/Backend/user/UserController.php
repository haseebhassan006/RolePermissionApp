<?php

namespace App\Http\Controllers\Backend\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logout(){
        Auth::logout();
        $url=route('login');
        return response()->json( $url);
    }
}
