<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

   
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function changePassword(Request $request)
    {

      if(auth()->Check())
      {
        $messages = [
        'current-password.required' => 'Please enter current password',
        'password.required' => 'Please enter password',
        ];

        $val_rule =  [
        'current-password' => 'required',
        'password' => 'required',
        'password_confirmation' => 'required|same:password',
        ];
         
        $request_data = $request->All();
        $request->validate($val_rule, $messages);

        $current_password = auth()->user()->password;           
        if(Hash::check($request_data['current-password'], $current_password))
        {           
            $user_id = auth()->user()->id;                       
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request_data['password']);
            $obj_user->save(); 
            return redirect()->back()->with('success', 'Password changed!');
        }
        else
        {           
            $error = array('current-password' => 'Please enter correct current password');
            return redirect()->back()->withErrors(array('current-password'=>$error));   
        }   
      }
      else
      {
        return redirect()->to('/');
      } 

    }
}
