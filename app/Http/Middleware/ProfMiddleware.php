<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProfMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role !== 'prof') {
            return redirect('/');
        }

        return $next($request);
    }
}

