<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Role;
use App\Http\Controllers\MailController;
 
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
    protected $mailctr;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->mailctr = new MailController();

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        //email for registered user
        $email = emailTemplate('register_email');
        $emaildata['subject'] = $email->subject;
        $email->message =   str_replace("{EMAIL}",$data['email'],$email->message);
        $email->message =   str_replace("{PASSWORD}",$data['password'],$email->message);
        $emaildata['mess'] = $email->message;
        $emaildata['email'] = $data['email'];
        $this->mailctr->register_email($emaildata);

        //email for admin   
        $emailadmin = emailTemplate('register_email_admin');
        // dd($emailadmin);
        $emaildata['subject'] = $emailadmin->subject;
        $emailadmin->message =   str_replace("{EMAIL}",$data['email'],$emailadmin->message);
         
        $emaildata['mess'] = $emailadmin->message;
        $emaildata['email'] = getConfig('email');
        $this->mailctr->register_email($emaildata);
        // assigning role to user 
        // $user->roles()->attach(Role::where('name','customer')->first());

        return $user;

        // echo "string";exit;
    }
}
