<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\WahajUser;
use Illuminate\Support\Facades\Auth;

class WahajAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('wahajuser_id')) {
            return redirect()->route('wahajwatan.login');
        }

        return $next($request);
    }
}
