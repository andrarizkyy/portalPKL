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

    // ──── Register Page (with role selection) ────
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:siswa,dudi',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_profile_completed' => false,
        ]);

        Auth::login($user, true);
        return $this->redirectByRole($user);
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

    // ──── Google OAuth (optional) ────
    public function redirectToGoogle()
    {
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

        // New user — store Google data in session, redirect to role selection
        session([
            'google_user' => [
                'id' => $googleUser->getId(),
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
            ]
        ]);

        return redirect()->route('select.role');
    }

    // ──── Role Selection (after Google OAuth for new users) ────
    public function showRoleSelection()
    {
        if (!session('google_user')) {
            return redirect('/login');
        }
        return view('auth.select-role');
    }

    public function storeRole(Request $request)
    {
        $request->validate(['role' => 'required|in:siswa,dudi']);

        $googleData = session('google_user');
        if (!$googleData) {
            return redirect('/login');
        }

        $user = User::create([
            'name' => $googleData['name'],
            'email' => $googleData['email'],
            'google_id' => $googleData['id'],
            'avatar' => $googleData['avatar'],
            'role' => $request->role,
            'is_profile_completed' => false,
        ]);

        session()->forget('google_user');
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