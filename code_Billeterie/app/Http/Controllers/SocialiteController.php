<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;  // Assurez-vous d'utiliser la bonne référence
use App\Models\User;
use Illuminate\Support\Str;


class SocialiteController extends Controller
{
    //
   
      // Les tableaux des providers autorisés
      protected $providers = [ "google"];

      # La vue pour les liens vers les providers
      public function loginRegister () {
          return view('auth.login');
      }
  
      # redirection vers le provider
      public function redirect (Request $request) {
  
          $provider = $request->provider;

          
  
          // On vérifie si le provider est autorisé
          if (in_array($provider, $this->providers)) {
              return Socialite::driver($provider)->redirect(); // On redirige vers le provider
          }
          abort(404); // Si le provider n'est pas autorisé
      }
  
      // Callback du provider
 // Callback du provider
 public function callback (Request $request) {

    $provider = $request->provider;

    if (in_array($provider, $this->providers)) {

        // Les informations provenant du provider
        $data = Socialite::driver($request->provider)->user();

        # Social login - register
        $email = $data->getEmail(); // L'adresse email
        $name = $data->getName(); // le nom

        # 1. On récupère l'utilisateur à partir de l'adresse email
        $user = User::where("email", $email)->first();

        # 2. Si l'utilisateur existe
        if (isset($user)) {

            // Mise à jour des informations de l'utilisateur
           // $user->name = $name;
            //$user->save();
            echo "user existe";
             # 4. On connecte l'utilisateur
        auth()->login($user);

        # 5. On redirige l'utilisateur vers /home
        if (auth()->check()) return redirect(route('dashboard'));


        # 3. Si l'utilisateur n'existe pas, on l'enregistre
        } 
        else {
            
          //on envoie un pop up pour demander à l'utilisateur s'il souhaite s'inscrire
          $confirmation = "<script>var confirmResult = confirm('Voulez-vous vous inscrire ?'); if (!confirmResult) {   window.history.go(-2) }</script>";
          // retour vers ma fonction register qui ce trouve daans ce controller
            return $this->register();

            
        }

       
     }
     abort(404);
}

public function register(){
    return view('auth.register');
}


public function callbackcreate (Request $request) {

    $provider = $request->provider;

    if (in_array($provider, $this->providers)) {

        // Les informations provenant du provider
        $data = Socialite::driver($request->provider)->user();

        # Social login - register
        $email = $data->getEmail(); // L'adresse email
        $name = $data->getName(); // le nom

        # 1. On récupère l'utilisateur à partir de l'adresse email
        $user = User::where("email", $email)->first();
    

        # 2. Si l'utilisateur existe
        if (isset($user)) {

            // Mise à jour des informations de l'utilisateur
           // $user->name = $name;
            //$user->save();
            echo "user existe";

        # 3. Si l'utilisateur n'existe pas, on l'enregistre
        } 
        else {
            //on creé un mots de passe aléatoire
            $password = Str::random(8);
            
            // Enregistrement de l'utilisateur
            $user = User::create([
                'first_name' => $name,
                'email' => $email,

                'password' => $password // On attribue un mot de passe
            ]);
        }

        # 4. On connecte l'utilisateur
        auth()->login($user);

        # 5. On redirige l'utilisateur vers /home
        if (auth()->check()) return redirect(route('dashboard'));

     }
     abort(404);
}
}