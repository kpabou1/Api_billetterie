<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Particulier;
use App\Models\SuiviMarche;
use App\Models\NumeroIdentificationFiscal;
use App\Models\Demande;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Vérification du rôle de l'utilisateur connecté
        $user = auth()->user();
        $role = $user->roles->first()->name;
    
        if ($role == 'UserClients') {
            return view('dashboard');
        }
    
        // Rôles autorisés
        $allowedRoles = ['Developpeur', 'UserClient', 'Admin'];
    
        if (in_array($role, $allowedRoles)) {
            // SuiviMarche conter nombre
         //   $suiviMarcheNbre = SuiviMarche::count();
          $suiviMarcheNbre = 0;

            // Récupération de la date actuelle
            $date = now();
           
           $date_jour_plus_10 = now()->addDays(10)->toDateString();
           // date du jour
           $date_jour = now()->toDateString();
          
           
          
           
     
       
            //dd($suiviMarcheNbreNON);
            // Récupération du nombre d'utilisateurs
            $nbre_users = User::count();
    
           
    
            return view('dashboard', compact(
                'nbre_users',

            ));
        }
    
        // Si l'utilisateur n'a aucun des rôles autorisés, rediriger ou afficher une erreur
        return redirect()->route('home')->with('error', 'Accès non autorisé');
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
