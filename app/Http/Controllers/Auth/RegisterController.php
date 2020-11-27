<?php

// defining Namespace
namespace App\Http\Controllers\Auth;

// using Laravel Facades
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'between:1,50'],
            'lastname' => ['required', 'string', 'between:1,50'],
            'email' => ['required', 'string', 'email', 'between:1,255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // TODO we can check if the user have at least 18 years
            'date_of_birth' => ['required', 'date', 'before:today'],
            'avatar' => 'image',
            'description' => ['required', 'string', 'between:1,500'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $path = null;
        if (isset($data['avatar']))
        {
            $path = Storage::disk('public')->put('images', $data['avatar']);
        }


        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'date_of_birth' => $data['date_of_birth'],
            'avatar' => $path,
            'description' => $data['description'],
        ]);
    }
}
