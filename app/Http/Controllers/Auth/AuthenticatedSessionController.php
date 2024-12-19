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
    public function Employee(): View
    {
        return view('auth.employee-Login');
    }
    public function EmployeeStore(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $user = $request->user(); // Get the authenticated user
        $user->update(['last_login' => now()]);
        $request->session()->regenerate();

        return redirect()->intended(route('employee.dashboard', absolute: false));
    }
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $user = $request->user(); // Get the authenticated user
        $user->update(['last_login' => now()]);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Update the user's last logout timestamp
        if ($user) {
            $user->update(['last_logout' => now()]);
        }
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
