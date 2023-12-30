<?php

namespace App\Http\Controllers\Sector_responsible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('Sector_responsible.home');
        }
}
