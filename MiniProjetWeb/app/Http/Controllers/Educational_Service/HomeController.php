<?php

namespace App\Http\Controllers\Educational_Service;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('Educational_Service.home');
    }
    public function home()
    {
        return view ('educational_service.indexusers');
    }
    
        
}
