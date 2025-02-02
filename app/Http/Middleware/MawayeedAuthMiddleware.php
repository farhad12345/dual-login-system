<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class MawayeedAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('mawayeeduser_id')) {
            return redirect()->route('almawayeed.login');
        }

        return $next($request);
    }
}
