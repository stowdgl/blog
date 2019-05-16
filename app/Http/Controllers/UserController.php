<?php

namespace App\Http\Controllers;

use App\Tools\UINotification;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function logout(Request $request)
    {
        if (auth()->check()){
            auth()->logout();
            $request->session()->invalidate();
            UINotification::set('success','Вы вышли!');
            return redirect('/');
        }else{
            UINotification::set('warning','Вы не авторизированы!');
            return redirect('/');
        }
    }
}
