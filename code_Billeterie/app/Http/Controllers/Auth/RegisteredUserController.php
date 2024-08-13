<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
     //dd($request);

        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'phone_number' => 'required|numeric|unique:users,telephone',
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],

            //'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            //'pass' => ['required', 'confirmed', Rules\Password::defaults()],
            'pass' => ['required'],
            //'datenaiss'=>['required'],
            //la date de naissance doit etre inferieur a la date d'aujourd'hui
           // 'datenaiss'=>['required','before:today'],
            //vérification si dans la variable contry_code c'est ceci :+undefined alors renvoyer une erreur

        ]);

        //si dans la requete il y a un email
        if($request->email){
            $request->validate([
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users,email', // Vérifie l'unicité de l'e-mail dans la table users
                ],
            ]);

        }
        //vérification du password et de la confirmation du password
        $request->validate([
            'pass' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user=new User();
        $user->firstname=$request->firstname;
        $user->lastname=$request->lastname;
        $user->username=$request->username;
        $user->indicatiftel=$request->country_code;
        $user->telephone=$request->phone_number;
        $user->email=$request->email;
        $user->password=Hash::make($request->pass);
       // dd($request->country_code);
       // dd($user);
        $user->save();
        $particlier_role = Role::where('name', 'UserClient')->first();
        //assignation du role particulier
           $user->assignRole($particlier_role);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
