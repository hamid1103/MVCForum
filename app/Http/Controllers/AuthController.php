<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        $login = $request->login;
        $user = User::where('email',$login)->orWhere('name', $login)->first();
        if (!$user) {
            $request->session()->flash('alert', [
                'type'=>'error',
                'message'=>'The provided credentials do not match our records.'
            ]);
            return back();
        }
        if (Auth::attempt(['email' => $user->email, 'password' => $request->password]) ||
            Auth::attempt(['username' => $user->name, 'password' => $request->password])) {
            Auth::loginUsingId($user->id);
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'username'=>'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function createUser(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'name' => ['required'],
            'password' => ['required','min:8'],
            'password_confirm'=>['required','same:password'],
        ]);

        //create user
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email
        ]);

        UserSettings::create([
            'user_id' => $user->id
        ]);

        event(new Registered($user));

        //log them in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/email/verify');
            //return Inertia::render('EmailVerification/CheckEmailVerification');
        }
        return back()->withErrors();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function update(Request $request): RedirectResponse
    {
        // Validate the new password length...

        $request->user()->fill([
            'password' => Hash::make($request->newPassword)
        ])->save();

        return redirect('/profile');
    }
}
