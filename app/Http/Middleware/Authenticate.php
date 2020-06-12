<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
        
    }

//     public function handle($request, Closure $next)
//     {
//         if (!Auth::check()) {
//             return redirect()->route('login');
//         }
//  abort(403);
//         // if (Auth::user()->role == 'admin') {
//         //     return redirect()->route('admin');
//         // }

//         // if (Auth::user()->role == 'staff') {
//         //     return redirect()->route('staff');
//         // }

   
//     }
}
