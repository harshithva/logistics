<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ( ! Auth::check()) {
            abort(403, 'Unauthorized action.');
        }
        
        if (Auth::guard($guard)->check()) {
            // return redirect(RouteServiceProvider::HOME);
        
                // User role
                $role = Auth::user()->role;
                // Check user role
                switch ($role) {
                    case 'admin':
                            return redirect(RouteServiceProvider::ADMIN);
                        break;
                    case 'employee':
                        return redirect(RouteServiceProvider::EMPLOYEE);
                        break; 
                    case 'customer':
                        return redirect(RouteServiceProvider::CUSTOMER);
                     break; 
                    default:
                    return redirect(RouteServiceProvider::LOGIN);
                        break;
                }
            
        }

        

        return $next($request);
    }
}
