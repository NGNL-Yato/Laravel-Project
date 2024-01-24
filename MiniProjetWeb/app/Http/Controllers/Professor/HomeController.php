<?php

namespace App\Http\Controllers\Professor;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Demande;
use Illuminate\Http\Request;

class HomeController extends Controller {

        public function home()
        {
            return view ('Professor.home');
        }        
        
}

