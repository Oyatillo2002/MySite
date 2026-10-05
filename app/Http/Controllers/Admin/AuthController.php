<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        // Validatsiya
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // .env fayldan ma'lumotlarni olish
        // Eslatma: Ishlab chiqarishda (production) bu usul xavfsiz emas, 
        // lekin shaxsiy portfolio uchun yetarli va tez.
        $adminEmail = env('ADMIN_EMAIL', 'admin@example.com');
        $adminPassword = env('ADMIN_PASSWORD', 'secret');

        if ($credentials['email'] === $adminEmail && $credentials['password'] === $adminPassword) {
            // Muvaffaqiyatli kirish
            session(['admin_logged_in' => true]);
            
            return redirect()->intended(route('admin.dashboard'));
        }

        // Xato holati
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log out of the application.
     */
    public function logout(Request $request)
    {
        session()->forget('admin_logged_in');
        
        return redirect()->route('admin.login');
    }
}