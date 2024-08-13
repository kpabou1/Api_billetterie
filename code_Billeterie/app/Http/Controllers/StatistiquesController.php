<?php

namespace App\Http\Controllers;

use App\Models\Annee;
use App\Models\Ppm;
use App\Models\SuiviMarche;

class StatistiquesController extends Controller
{
    //

    public function index()
    {
        $annees = Annee::all();
        return view('statistiques.index', compact('annees'));
    }

    public function getMarchesParPpm($id)
    {
        // Le nombre de marchés approuvés par rapport au PPM
        // À ce niveau, si on prend un PPM exemple un ID de PPM, on doit pouvoir connaître le nombre de marchés approuvés
        // par rapport à ce PPM

        // Récupération du nombre de PPMs de l'année
        $ppms = Ppm::where('id_annee', $id)->count();
        // Récupération du nombre de marchés de l'année et dont l'état d'approbation est 'Oui'
        $marches_approuves = Ppm::where('id_annee', $id)->where('statut_approbation', 'Oui')->count();
        $marches_non_approuves = Ppm::where('id_annee', $id)->where('statut_approbation', 'Non')->count();

         //recupération de l'année et du statut
         $annees = Annee::where('id', $id);
         $statut = $annees->first()->statut;
         $libelle = $annees->first()->libelle;
 
 

        // Return
        return response()->json([
            'ppms' => $ppms,
            'marches_approuves' => $marches_approuves,
            'marches_non_approuves' => $marches_non_approuves,
            'statut' => $statut,
            'libelle' => $libelle,
            
        ]);
    }
    public function getMontantsParPpm($id)
    {
        $montant_previsionnel_total_ppms = Ppm::where('id_annee', $id)->sum('montant_previsionnel');
        //recupération de l'année et du statut
        $annees = Annee::where('id', $id);
        $statut = $annees->first()->statut;
        $libelle = $annees->first()->libelle;


        $montant_previsionnel_total_ppms_approuve = Ppm::where('id_annee', $id)->where('statut_approbation', 'Oui')->sum('montant_previsionnel');
        $montant_previsionnel_total_ppms_non_approuve = Ppm::where('id_annee', $id)->where('statut_approbation', 'Non')->sum('montant_previsionnel');
        $montant_attribution_total_ppms = SuiviMarche::where('annees_id', $id)->sum('montant_attribution');

        return response()->json([
            'montant_previsionnel_total_ppms' => $montant_previsionnel_total_ppms,
            'montant_previsionnel_total_ppms_approuve' => $montant_previsionnel_total_ppms_approuve,
            'montant_previsionnel_total_ppms_non_approuve' => $montant_previsionnel_total_ppms_non_approuve,
            'montant_attribution_total_ppms' => $montant_attribution_total_ppms,
            'statut' => $statut,
            'libelle' => $libelle,
        ]);
    }


    public function getFiltrerParSubvention($id)
    {
        $subventions = Ppm::whereHas('suiviMarches', function ($query) use ($id) {
            $query->where('annees_id', $id);
        })->get();

        return response()->json($subventions);
    }
}
