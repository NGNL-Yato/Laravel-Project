<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        // return view('Student.annonces');
        return redirect('/Student/annonces');
        }
}
