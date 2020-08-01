<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
// use App\Services\SocialFacebookAccountService;
class SocialAuthFacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback()
    {
        // // dd("aman");
        // $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        // auth()->login($user);
        // return redirect()->to('/');
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
             return redirect('/login');
        }
        // dd($user);
        $existingUser = User::where('email', $user->email)->first();
        
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser  = new User();
            $newUser->firstname            = $user->name;
            $newUser->email           = $user->email;
            $newUser->facebook_id       = $user->id; 
            $newUser->password = md5(rand(1,10000));
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->to('/');
       
    }
}
