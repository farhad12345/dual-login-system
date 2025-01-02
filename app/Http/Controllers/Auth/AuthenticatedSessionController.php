<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\EmployeRequest;

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
    public function EmployeeStore(EmployeRequest $request)
    {
        // Check if the user exists with the given email and password before authenticating
        $user = User::where('email', $request->email)->first();

        // If user doesn't exist or the status is not 'accepted', show an error
        if (!$user || $user->status !== 'accepted') {
            return redirect()->route('employee-login')->with('status', 'يرجى الانتظار حتى يتم الموافقة على حسابك من قبل المسؤول.');
        }

        // Authenticate the user
        $request->authenticate();

        // Regenerate the session after successful authentication
        $request->session()->regenerate();

        // Update the last login time
        $user->update(['last_login' => now()]);

        // Redirect to the intended route or employee dashboard
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
