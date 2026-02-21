<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
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

    // ──── Manual Register for Siswa / DUDI ────
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
            'google_id' => null,
            'is_profile_completed' => false,
        ]);

        Auth::login($user, true);
        return $this->redirectByRole($user);
    }

    // ──── Google OAuth ────
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

        $user = User::where('google_id', $googleUser->getId())->first();

        if ($user) {
            Auth::login($user, true);
            return $this->redirectByRole($user);
        }

        // Check if email already exists (registered manually)
        $existingUser = User::where('email', $googleUser->getEmail())->first();
        if ($existingUser) {
            $existingUser->update([
                'google_id' => $googleUser->getId(),
                'profile_photo' => $googleUser->getAvatar(),
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
            'profile_photo' => $googleData['avatar'],
            'role' => $request->role,
            'is_profile_completed' => false,
        ]);

        session()->forget('google_user');
        Auth::login($user, true);

        return $this->redirectByRole($user);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function redirectByRole($user)
    {
        return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'siswa' => redirect()->route('siswa.dashboard'),
                'dudi' => redirect()->route('dudi.dashboard'),
                default => redirect('/'),
            };
    }
}