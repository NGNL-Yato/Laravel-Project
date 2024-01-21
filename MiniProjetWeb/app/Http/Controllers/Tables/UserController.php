<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function listUsers()
    {
        $users = User::all();
        return view('Educational_Service.home', compact('users'));
    }
}
