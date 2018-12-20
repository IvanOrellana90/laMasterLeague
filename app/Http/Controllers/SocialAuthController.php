<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Socialite;
use App\Avatar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SocialAuthController extends Controller
{
    // Metodo encargado de la redireccion a Facebook
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider)
    {
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->user();

        // Comprobamos si el usuario ya existe
        if ($user = User::where('email', $social_user->email)->first()) {
            return $this->authAndRedirect($user); // Login y redirección
        } else {
            // En caso de que no exista creamos un nuevo usuario con sus datos.
            $avatar = Avatar::where('level',1)->inRandomOrder()->first();
            $user = User::create([
                'name' => $social_user->name,
                'email' => $social_user->email,
                'avatar_id' => $avatar->id
            ]);

            return $this->authAndRedirect($user); // Login y redirección
        }
    }

    // Login y redirección
    public function authAndRedirect($user)
    {
        Auth::login($user);

        return redirect()->route('home');
    }
}
