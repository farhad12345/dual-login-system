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
use Illuminate\Support\Facades\Artisan;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
public function create(Request $request): View
{
     $this->clear();
    return view('auth.login');
}

    public function Employee(Request $request): View
    {

 
   $this->clear();
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
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return redirect('/');
        $this->clear();
        return redirect('/clear');
    }
    private function clear()
    {
            Artisan::call('cache:clear');

    // Clear route cache
    Artisan::call('route:clear');

    // Clear config cache
    Artisan::call('config:clear');

    // Clear view cache
    Artisan::call('view:clear');

    // Clear compiled classes
    Artisan::call('optimize:clear');
    
       Auth::logout();

    return 'as';
    }
}
