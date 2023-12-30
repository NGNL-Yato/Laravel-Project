<?php

namespace App\Http\Controllers\Department_chief;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('Department_chief.home');
        }
}

