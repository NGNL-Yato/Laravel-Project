<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::EDUCATIONAL_SERVICE_USERS;
<<<<<<< Updated upstream
public function register(Request $request)
{
    $this->validator($request->all())->validate();

    event(new Registered($user = $this->create($request->all())));

    // The following line is commented out to prevent auto-login
    // $this->guard()->login($user);

    if ($response = $this->registered($request, $user)) {
        return $response;
    }

    return $request->wantsJson()
                ? new JsonResponse([], 201)
                : redirect($this->redirectPath());
}
=======
>>>>>>> Stashed changes
    /**
     * Create a new controller instance.
     *
     * @return void
     */
<<<<<<< Updated upstream
    // public function __construct()
    // {
    //     //$this->middleware('guest');
    // }
=======
    public function __construct()
    {
        //removed the middlewar to let the admin create
    }
>>>>>>> Stashed changes

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'integer'],
        ]);
    }
    //Redirect you to the Educational_Service user since its the one whose creating accounts 
    // localy in hes home page (users section in our case)
        protected function redirectTo()
    {
        return route('Educational_Service.users');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
<<<<<<< Updated upstream
            'role' => $data['role']
=======
            'role' => $data['user_role'], // Assuming you have a 'role' field in your users table
>>>>>>> Stashed changes
        ]);
    }
}
