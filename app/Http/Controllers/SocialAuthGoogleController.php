<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
// use App\Services\SocialFacebookAccountService;
class SocialAuthGoogleController extends Controller
{
    public function redirect()
    {
         return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
       try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            // dd($e);
            return redirect('/login');
        }
        $existingUser = User::where('email', $user->email)->first();
        // dd($user);
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser  = new User();
            $newUser->firstname            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id; 
            $newUser->password = md5(rand(1,10000));
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->to('/');
       
    }
}
