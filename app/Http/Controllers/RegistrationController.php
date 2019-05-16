<?php

namespace App\Http\Controllers;

use App\Tools\UINotification;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class RegistrationController extends Controller
{
    public function register(Request $request)
    {
         $validatedData = ($request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => ['required'],
            'birthday-date' =>['required'],
        ]));
        try {
            $date = \DateTime::createFromFormat('d/m/Y', $request['birthday-date']);
            $date = $date->format('Y-m-d');

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'birthday-date' => $date,
            ]);
            auth()->login($user);
            UINotification::set('success','Вы успешно зарегистрированы!');
            return redirect()->route('home-page');
        }
        catch (\Exception $exception)
        {
            UINotification::set('error','Произошла ошибка!');
            return redirect('/register');
        }
    }

}