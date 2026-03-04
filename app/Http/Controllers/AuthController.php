<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // ──── Login Page ────
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return $this->redirectByRole(Auth::user());
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    // ──── Google OAuth (Google Only for Siswa/Dudi) ────
    public function redirectToGoogle($role = null)
    {
        if ($role) {
            session(['google_auth_intent' => 'register', 'google_login_role' => $role]);
        }
        else {
            session(['google_auth_intent' => 'login']);
        }
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        }
        catch (\Exception $e) {
            return redirect('/login')->withErrors(['google' => 'Login Google gagal: ' . $e->getMessage()]);
        }

        $intent = session('google_auth_intent', 'login');

        // Existing user with google_id
        $user = User::where('google_id', $googleUser->getId())->first();
        if ($user) {
            Auth::login($user, true);
            return $this->redirectByRole($user);
        }

        // Email already exists (link google)
        $existingUser = User::where('email', $googleUser->getEmail())->first();
        if ($existingUser) {
            $existingUser->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);
            Auth::login($existingUser, true);
            return $this->redirectByRole($existingUser);
        }

        // Handle case where user doesn't exist
        if ($intent === 'login') {
            return redirect('/login')->withErrors(['google' => 'Akun belum terdaftar. Silakan daftar terlebih dahulu.']);
        }

        // New user registration flow
        $role = session('google_login_role');
        if (!$role) {
            return redirect('/login')->withErrors(['google' => 'Role pendaftaran tidak ditemukan. Silakan coba lagi.']);
        }

        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => Hash::make($googleUser->getId()), // Use Google ID as password hash (temporary)php
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
            'role' => $role,
            'is_profile_completed' => false,
        ]);

        session()->forget(['google_auth_intent', 'google_login_role']);
        Auth::login($user, true);
        return $this->redirectByRole($user);
    }

    // ──── Logout ────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // ──── Redirect Helper ────
    private function redirectByRole($user)
    {
        if (!$user->is_profile_completed && !$user->isAdmin()) {
            return match ($user->role) {
                    'siswa' => redirect()->route('siswa.profil'),
                    'dudi' => redirect()->route('dudi.profil'),
                    default => redirect('/'),
                };
        }

        return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'siswa' => redirect()->route('siswa.dashboard'),
                'dudi' => redirect()->route('dudi.dashboard'),
                default => redirect('/'),
            };
    }
}