<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    protected $redirectTo = '/home';

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
            'NIP' => 'required|string|max:25',
            'username' => 'required|string|max:20|unique:user',
            'password' => 'required|string|min:6|confirmed',
            'Nama' => 'required|string|max:25',
            'Kantor' => 'required|string|max:255',
            'Jabatan' => 'required|string|max:25',
            'Divisi' => 'required|string|max:50',
            'id_grup' => 'required|numeric'
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
        return User::create([
            'NIP' => $data['NIP'],
            'Nama' => $data['Nama'],
            'Kantor' => $data['Kantor'],
            'Jabatan' => $data['Jabatan'],
            'Divisi' => $data['Divisi'],
            'id_grup' => $data['id_grup'],
            'username' => strtolower($data['username']),
            'password' => bcrypt($data['password'])
        ]);
    }
}
