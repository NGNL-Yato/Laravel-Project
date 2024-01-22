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
        return view('Educational_Service.users', compact('users'));
    }
    public function destroy(User $user)
    {
        // Deletes the ID after getting it from the page 
        // to resume it redirects the user ine a page /users/{userid}
        // gets the id to delet it and after deleting it it redirects to the
        // same page, in this case educational_service.users
        $user->delete();

        return redirect()->route('Educational_Service.users');
    }

    public function update(Request $request, User $user)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|integer', // Adjust validation rules as needed
        ]);
    
        // Update user data
        $user->update($validatedData);
    
        // Redirect or return a response as needed
        return redirect()->route('Educational_Service.users')->with('success', 'User updated successfully');
    }
    
}
