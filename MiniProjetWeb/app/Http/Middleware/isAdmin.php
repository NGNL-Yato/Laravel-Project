<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            $firstSegment = $request->segment(1);

            $roleMap = [
                1 => 'Student',
                2 => 'Professor',
                3 => 'Sector_responsible',
                4 => 'Department_chief',
                5 => 'Educational_Service',
                0 => 'auth' //Still here by default, can be deleted since its useless or keep it to give him a free hand on all routes later
            ];

            if (isset($roleMap[$role]) && $firstSegment !== $roleMap[$role]) {
                return redirect()->route($roleMap[$role] . '.home');
            }
            //Checks if the first Segment is true else redirect you to the home(all home has been changed to redirect somewhere else)
            //http://localhost:8000/Educational_Service/home
            //here Educational_Service is the firstSegment
            return $next($request);
        } else {
            return redirect()->route('welcome');
        }
    }
}


//Potential new middleware


// <?php
// public function handle(Request $request, Closure $next)
// {
//     if (auth()->check()) {
//         $role = auth()->user()->role;
//         $currentRouteName = $request->route()->getName();

//         $roleMap = [
//             1 => 'Student',
//             2 => 'Professor',
//             3 => 'Sector_responsible',
//             4 => 'Department_chief',
//             5 => 'Educational_Service',
//             0 => 'auth',
//             // Add other roles here
//         ];

//         $pages = ['home', 'profile', 'announces']; // Add other page names here

//         if (isset($roleMap[$role])) {
//             foreach ($pages as $page) {
//                 $routeName = $roleMap[$role] . '.' . $page;
//                 if (strpos($currentRouteName, $routeName) === 0) {
//                     if (Route::has($routeName)) {
//                         return $next($request);
//                     } else {
//                         return redirect()->route($roleMap[$role] . '.home');
//                     }
//                 }
//             }
//             return redirect()->route($roleMap[$role] . '.home');
//         }
//     }

//     return redirect()->route('welcome');
// }
//