<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegisteredEmail;

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
    protected $redirectTo = 'admin';

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
        $email = isset($data['email']) ? ','.$data['email'].',email':'';
    
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
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
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cpf' => $data['cpf'],
            'birthday' => date('Y-m-d', strtotime($data['birthday'])),
            'areacode' => '11',
            'phone' => $data['phone'],
	        'role'     => 'ROLE_USER'
        ]);
    }


    protected function edit(array $data)
    {
        return view('auth.edit');

    }


    protected function registered(Request $request, $user) {

		Mail::to($user->email)->send(new UserRegisteredEmail($user));

		if($user->role == 'ROLE_OWNER')
			return redirect()->route('admin.stores.index');

		if($user->role == 'ROLE_USER' && session()->has('cart')) {
			return redirect()->route('checkout.index');
		} else {
			return redirect()->route('inicial');
		}

        return null;
    }


}
