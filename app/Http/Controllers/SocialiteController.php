<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SocialiteController extends Controller
{
        /**
         * @param NA
         *  @return void
         */
        public function googleLogin(){
            return Socialite::driver('google')->redirect();
        }

                /**
             * @param NA
             *  @return void
             */
            public function googleAuthentication(){
                try {
                    $googleUser = Socialite::driver('google')->stateless()->user();

                    $user = User::where('google_id', $googleUser->id)->first();
                    if ($user){
                        Auth::login($user);
                        return redirect()->route('welcome');
                    } else {
                        $userData = User::create([
                            'name' => $googleUser->name,
                            'email' => $googleUser->email,
                            'password' => Hash::make('Password@1234'),
                            'google_id' => $googleUser->id,
                        ]);

                        if ($userData) {
                            Auth::login($userData);
                            return redirect()->route('login');
                        }
                    }
                } catch (Exception $e) {
                    dd($e);
                }

            }

}
