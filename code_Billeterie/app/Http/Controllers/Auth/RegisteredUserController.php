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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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
            'ville' => ['required', 'string', 'max:255'],            'lastname' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'entreprise' => ['required', 'string', 'max:255'],


         
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
        //dd('a');

        //je créer un mot de passe puis un username composé des deux premiere lettre du nom  et je colle au prenom  dans des variables
        //je génère 4 lettre aléatoire raandom 
        $random = Str::random(4);
        $pass=substr($request->firstname,0,2).substr($request->lastname,0,2);
        $pass=$pass.$random;
        $username=substr($request->firstname,0,2).$request->lastname;
        //if username existe dans la base user redirect back l'user existe 
        $user = User::where('username', $username)->first();
        if ($user) {
            return back()->withErrors(['error' => 'Ce nom d\'utilisateur est déjà utilisé. Veuillez en choisir un autre.']);
        }
        $infos = [
            'password' => $pass,
            'username' => $username,
            'nom' => $request->lastname,
            'prenom' => $request->firstname,
            'email' => $request->email,
            
        ];
        // Essayez d'envoyer l'email
        try {
            Mail::send('emails.accuser_ouverture', ['infos' => $infos], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Accusé de Réception d\'Ouverture de Compte');
            });
        } catch (\Swift_TransportException $e) {
            // Erreur liée à l'envoi de l'email (problème de domaine, serveur de messagerie, etc.)
            return back()->withErrors(['error' => 'Nous ne parvenons pas à envoyer le message. Il y a peut-être un problème avec votre domaine ou serveur de messagerie.']);
        } catch (\Exception $e) {
            // Autres types d'erreurs
            return back()->withErrors(['error' => 'Une erreur inconnue s\'est produite lors de l\'envoi du code. Veuillez réessayer plus tard.']);
        }

       

        $user=new User();
        $user->firstname=$request->firstname;
        $user->lastname=$request->lastname;
        $user->username=$username;

        $user->indicatiftel=$request->country_code;
        $user->telephone=$request->phone_number;
        $user->email=$request->email;
        $user->password=Hash::make($pass);

        $user->save();
        $particlier_role = Role::where('name', 'UserClient')->first();
        //assignation du role particulier
           $user->assignRole($particlier_role);
          // dd($particlier_role);

        event(new Registered($user));

        
    // Redirection vers la page de connexion
    return redirect()->route('login')->with('status', 'Votre compte a été créé avec succès. Veuillez vous connecter.');
    }
}
