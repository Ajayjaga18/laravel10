<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    public function store(Request $request): RedirectResponse
    {
        // Validate email and password fields
        $validatedData = $request->validate([
            'email' => 'required|email', // Added email format validation
            'password' => 'required|string', // Ensure password is a string
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();

            // Redirect to intended page (usually dashboard)
            return redirect()->intended(route('dashboard'));
        }

        // If authentication fails, redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
            'password' => 'The provided password are incorrect.',
        ])->withInput($request->only('email'));  // Keep the entered email value
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
