<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /** Restrict administrative pages to users explicitly marked as admins. */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (! $request->user()?->is_admin) {
            return to_route('profile.edit');
        }

        return $next($request);
    }
}
