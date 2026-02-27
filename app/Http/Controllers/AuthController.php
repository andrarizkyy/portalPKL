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

    // ──── Admin Login (separate) ────
    public function showAdminLogin()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
            return back()->withErrors(['email' => 'Akun ini bukan admin.']);
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    // ──── Google OAuth (Google Only for Siswa/Dudi) ────
    public function redirectToGoogle($role)
    {
        session(['google_login_role' => $role]);
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        }
        catch (\Exception $e) {
            return redirect('/login')->withErrors(['google' => 'Login Google gagal: ' . $e->getMessage()]);
        }

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

        // New user — get role from session and create user automatically
        $role = session('google_login_role');
        if (!$role) {
            return redirect('/login')->withErrors(['google' => 'Role tidak ditemukan. Silakan masuk kembali.']);
        }

        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
            'role' => $role,
            'is_profile_completed' => false,
        ]);

        session()->forget('google_login_role');
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