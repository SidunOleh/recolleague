<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSubscribedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            $user = $request->user() and
            ($user->is_admin or $user->onTrial() or $user->subscribed('default'))
        ) {
            return $next($request);
        }

        return $request->ajax() ? 
            response(['location' => route('pages.home') . '#pay']) : 
            redirect(route('pages.home') . '#pay');
    }
}
