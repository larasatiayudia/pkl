<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;


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

    protected function redirectPath()
    {
        if(\Auth::guard('superadmin')->check()){
            return 'admin/users';
        }else{
            return '/';
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function($request,$next){
            return $next($request);
        });
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
<<<<<<< HEAD
            'password' => 'required|string|min:6',
            'nama' => 'required|string|max:25',
            'id_kantor' => 'required|max:255',
            'id_jabatan' => 'required|string|max:25',
=======
            'password' => 'required|string|min:6|confirmed',
            'Nama' => 'required|string|max:25',
            'Kantor' => 'required|string|max:255',
            'id_jabatan' => 'required|numeric',
          //  'id_divisi' => 'required|numeric',
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
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
<<<<<<< HEAD
            'Nama' => $data['nama'],
            'id_kantor' => $data['id_kantor'],
            'id_jabatan' => $data['id_jabatan'],
            'Status' => 0,
=======
            'Nama' => $data['Nama'],
            'Kantor' => $data['Kantor'],
            'id_jabatan' => $data['id_jabatan'],
           // 'id_divisi' => $data['id_divisi'],
>>>>>>> fa122edbca942ccf9aae4179d40f3ee3360513ad
            'id_grup' => $data['id_grup'],
            'username' => strtolower($data['username']),
            'password' => bcrypt($data['password']),
            'point' => 0,
            'registered_pw' => $data['password']
        ]);
    }
}
