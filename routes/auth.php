<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $token = bin2hex(random_bytes(32)); // Custom token for cookie
            return redirect('/profil')->cookie('auth_token', $token, 60*24*30);
        }

        return back()->withErrors([
            'email' => 'Nesprávne prihlasovacie údaje.',
        ])->onlyInput('email');
    });

    Route::get('/register', function () {
        return view('register');
    });

    Route::post('/register', function (Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:4'],
        ]);

        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        Auth::login($user);
        $token = bin2hex(random_bytes(32));

        return redirect('/profil')->cookie('auth_token', $token, 60*24*30);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profil', function () {
        return view('profile');
    })->name('profile');

    Route::get('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->withoutCookie('auth_token');
    });
});
