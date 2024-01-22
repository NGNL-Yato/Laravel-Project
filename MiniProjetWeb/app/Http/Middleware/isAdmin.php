<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            $currentRouteName = $request->route()->getName();
            //Checks if the user is connected o
            if ($role == 1 && $currentRouteName != 'Student.home') { 
                return redirect()->route('Student.home');
            } elseif ($role == 2 && $currentRouteName != 'Professor.home') {
                return redirect()->route('Professor.home');
            } elseif ($role == 3 && $currentRouteName != 'Sector_responsible.home') {
                return redirect()->route('Sector_responsible.home');
            } elseif ($role == 4 && $currentRouteName != 'Department_chief.home') {
                return redirect()->route('Department_chief.home');
            } elseif ($role == 5 && $currentRouteName != 'Educational_Service.home') {
                return redirect()->route('Educational_Service.home');
            } elseif ($role == 0 && $currentRouteName != 'auth.home') {
                return redirect()->route('auth.home');
            }
            return $next($request);
        } else {
            return redirect()->route('welcome');
        }
        //updated middleware to redirect when not connected to the home page
    }
}
