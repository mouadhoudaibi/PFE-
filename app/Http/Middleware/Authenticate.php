<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if ($request->is('admin/*')) {
                return route('admin.login'); 
            } elseif ($request->is('prof/*')) {
                return route('prof.login'); 
            } elseif ($request->is('etudiant/*')) {
                return route('etudiant.login'); 
            }

            return route('login'); 
        }

        return null;
    }
}
