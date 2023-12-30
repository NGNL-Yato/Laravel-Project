<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check()){
            if(auth()->user()->is_role == 1) {
                return redirect()->route('Student.home');
            } else if (auth()->user()->is_role == 2){
                return redirect()->route('Professor.home');
            } else if (auth()->user()->is_role == 3){
                return redirect()->route('Sector_responsible.home');
            } else if (auth()->user()->is_role == 4){
                return redirect()->route('Department_chief.home');
            } else if (auth()->user()->is_role == 5){
                return redirect()->route('Educational_service.home');
            } else {
                return $next($request); // if 0 == admin
            }
        }
    }
    
}
