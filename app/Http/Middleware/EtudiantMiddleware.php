<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EtudiantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role !== 'etudiant') {
            return redirect('/');
        }

        return $next($request);
    }
}

