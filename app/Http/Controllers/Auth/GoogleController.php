<?php
  
namespace App\Http\Controllers\Auth;
  
use Exception;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
     
            $userWithGoogleId = User::where('google_id', $user->id)->first();
     
            if ($userWithGoogleId) {
     
                Auth::login($userWithGoogleId);

                broadcast(new \App\Events\UserIsLoggedIn($userWithGoogleId))->toOthers();
    
                return redirect()->route('room.index');
     
            } else {

                $faker = \Faker\Factory::create();
                $name = $user->name;
                $slug = Str::slug($name);

                $userExistsWithSlug = User::where('slug', $slug)->first();

                if ($userExistsWithSlug) {
                    // Generate new username
                    $name = $name . $faker->randomNumber(3);
                    $slug = Str::slug($name);
                }

                $newUser = new User([
                    'name' => $name,
                    'slug' => $slug,
                    'email' => $user->email,
                    'password' => Hash::make($faker->password(10, 30)),
                    'settings' => [
                        'message_color' => $faker->hexColor()
                    ],
                    'google_id' => $user->id,
                ]);

                $newUser->email_verified_at = now();
                $newUser->is_active = true;
                $newUser->save();
    
                Auth::login($newUser);
     
                return redirect()->route('user.profile', $newUser);
            }
    
        } catch (Exception $e) {
            abort(400, $e->getMessage());
        }
    }
}