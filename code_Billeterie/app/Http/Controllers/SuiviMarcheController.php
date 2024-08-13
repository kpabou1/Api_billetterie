<?php

namespace App\Http\Controllers;
use App\Models\SuiviMarche;
use DataTables;
use Carbon\Carbon;
//année
use App\Models\Annee;
use App\Models\Ppm;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuiviMarchesExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class SuiviMarcheController extends Controller
{
    // Constructeur pour les permissions
    public function __construct()
    {
        $this->middleware('permission:suivi_marches-list|suivi_marches-create|suivi_marches-edit|suivi_marches-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:suivi_marches-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:suivi_marches-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:suivi_marches-delete', ['only' => ['destroy']]);
    }
    //
    public function index(Request $request)
    {
        $annees = Annee::all();
    
        // Initialisation de la requête
        $data = SuiviMarche::with(['ppms', 'annee'])->orderBy('created_at', 'desc');
    
        // Si la requête est AJAX et contient des dates de filtrage ou des filtres par subvention et année
        if ($request->ajax()) {
            if ($request->filled('from_date') && $request->filled('to_date')) {
                $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
                $toDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
                $data->whereBetween('date', [$fromDate, $toDate]);
            }
    
            if ($request->filled('subvention')) {
                $data->whereHas('ppms', function($query) use ($request) {
                    $query->where('subvention', $request->subvention);
                });
            }
    
            if ($request->filled('annee')) {
                $data->where('annees_id', $request->annee);
            }
    
            return DataTables::of($data)
                // add columns with ppms information
                ->addColumn('libelle_marches', function ($row) {
                    return $row->ppms->libelle_marches ?? 'N/A';
                })
                ->addColumn('subvention', function ($row) {
                    return $row->ppms->subvention ?? 'N/A';
                })
                ->addColumn('mode_passation', function ($row) {
                    return $row->ppms->mode_passation ?? 'N/A';
                })
                ->addColumn('ligne_budgetaire', function ($row) {
                    return $row->ppms->ligne_budgetaire ?? 'N/A';
                })
                ->addColumn('montant_previsionnel', function ($row) {
                    return $row->ppms->montant_previsionnel ?? 'N/A';
                })
                ->addColumn('trimestre_sortie_fonds', function ($row) {
                    return $row->ppms->trimestre_sortie_fonds ?? 'N/A';
                })
                ->addColumn('libelle', function ($row) {
                  //  $annee = $row->annee->libelle ?? 'N/A';
                    //recupération de l'id 
                    $id = $row->ppms->id;
                    //dans la table annee recupération de l'anne
                    $annee = Annee::where('id', $id)->first()->libelle ?? 'N/A';

                    return $annee;
                })
                ->addColumn('action', function ($row) {
                    return '
                    <div class="d-flex gap-2">
                        <a href="' . route('suivi_marches.edit', ['id' => $row->id]) . '" class="btn btn-sm btn-outline-info">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="' . route('suivi_marches.show', ['id' => $row->id]) . '" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-eye"></i>
                        </a>
                        <form action="' . route('suivi_marches.destroy', ['id' => $row->id]) . '" method="POST" class="d-inline">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-outline-danger delete-btn">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <a href="' . route('suivi_marches.imprimer_marcher', ['id' => $row->id]) . '" class="btn btn-sm btn-outline-primary">
                            Imprimer le marcher
                        </a>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('suivi_marches.index', compact('annees')); // Vue de la liste des marchés à afficher initialement
    }
    

    public function imprimer_marcher(Request $request)
    {
        
        $data = SuiviMarche::with(['ppms', 'annee'])
        ->where('id', $request->id)
        ->get()
        ->map(function($item) {
            return [
                'numero_marche' => $item->id,
                'ligne_budgetaire' => $item->ppms->ligne_budgetaire ?? 'N/A',
                'subvention' => $item->ppms->subvention ?? 'N/A',
                'libelle_marches' => $item->ppms->libelle_marches ?? 'N/A',
                'mode_passation' => $item->ppms->mode_passation ?? 'N/A',
                'trimestre_sortie_fonds' => $item->ppms->trimestre_sortie_fonds ?? 'N/A',
                'montant_previsionnel' => $item->ppms->montant_previsionnel ?? 'N/A',
                'montant_attribution' => $item->montant_attribution ?? 'N/A',
                'difference' => $item->difference ?? 'N/A',
                'titulaire' => $item->titulaire ?? 'N/A',
                'adresse' => $item->adresse_contact ?? 'N/A',
                'date_approbation' => $item->date_approbation ?? 'N/A',
                'date_ordre_service' => $item->date_ordre_service ?? 'N/A',
                'delai_execution' => $item->delai_execution ?? 'N/A',
                'date_probable_reception' => $item->date_probable_reception ?? 'N/A',
                'etat_paiement' => $item->etat_paiement ?? 'N/A',
            ];
        });

     //   dd($data);

        $pdf = Pdf::loadView('suivi_marches.imprimer_marcher', compact('data'));

        return $pdf->download('suivi_marches.pdf');//Télecharger au lieux de voir download

}

    public function export(Request $request)
    {
        // Valider l'année sélectionnée
        $request->validate([
            'annee' => 'required|exists:annees,id',
        ]);
    
        $anneeId = $request->input('annee');
        $annee = Annee::find($anneeId);
    
        // Vérifiez si l'année existe
        if (!$annee) {
            return redirect()->back()->withErrors(['annee' => 'Année non trouvée']);
        }
    
        // Préparer les données avec les jointures nécessaires
        $data = SuiviMarche::with(['ppms', 'annee'])
            ->where('annees_id', $anneeId)
            ->get()
            ->map(function($item) use ($annee) {
                return [
                    'numero_marche' => $item->id,
                    'ligne_budgetaire' => $item->ppms->ligne_budgetaire ?? 'N/A',
                    'subvention' => $item->ppms->subvention ?? 'N/A',
                    'libelle_marches' => $item->ppms->libelle_marches ?? 'N/A',
                    'mode_passation' => $item->ppms->mode_passation ?? 'N/A',
                    'trimestre_sortie_fonds' => $item->ppms->trimestre_sortie_fonds ?? 'N/A',
                    'montant_previsionnel' => $item->ppms->montant_previsionnel ?? 'N/A',
                    'montant_attribution' => $item->montant_attribution ?? 'N/A',
                    'difference' => $item->difference ?? 'N/A',
                    'titulaire' => $item->titulaire ?? 'N/A',
                    'adresse' => $item->adresse ?? 'N/A',
                    'date_approbation' => $item->date_approbation ?? 'N/A',
                    'date_ordre_service' => $item->date_ordre_service ?? 'N/A',
                    'delai_execution' => $item->delai_execution ?? 'N/A',
                    'date_probable_reception' => $item->date_probable_reception ?? 'N/A',
                    'etat_paiement' => $item->etat_paiement ?? 'N/A',
                    'libelle_annee' => $annee->libelle,
                ];
            });
          //  dd($data);
    
        // Générer le fichier Excel
        return Excel::download(new SuiviMarchesExport($data), 'suivi_marches.xlsx');
    }
    
    
    public function create(Request $request)
    {
        // Logique pour afficher le formulaire de création
        if (!Annee::where('statut', 'En cours')->exists()) {
            return redirect()->route('annees.index')->with('error', 'Aucune année en cours. Veuillez créer une année en cours avant de continuer.');
        }
        //recupération des ppm 
        $etape = 'chois_ppm';

        $ppms = Ppm::all();

        $annees = Annee::all();
    
        if ($request->ajax()) {
            $data = Ppm::query()->orderBy('created_at', 'desc');
    
            if ($request->filled('from_date') && $request->filled('to_date')) {
                $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
                $toDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
    
                $data->whereBetween('created_at', [$fromDate, $toDate]);
            }
    
            if ($request->filled('subvention')) {
                $data->where('subvention', $request->subvention);
            }
    
            if ($request->filled('annee')) {
                $data->where('id_annee', $request->annee);
            }
    
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-sm btn-info">Détails</button>';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        //retur
       
        return view('suivi_marches.create', compact('ppms', 'etape','annees'));

    }

    public function create_enregistrement(string $id)
    {

        //recherche du ppm

    $ppm = Ppm::where('id', $id)->get();

    //on vérifie s'il i y'a l'id du ppms dans la table suivie si oui on fais un retour avec un message ce ppms à déjàs été enregstrer veuillez aller dans suivie pour soit le modifier au le suprimer
    $suivi = SuiviMarche::where('ppms_id', $id)->get();
    
    if($suivi->count() > 0){
        return redirect()->route('suivi_marches.index')->with('error', 'Ce ppms a déjà été enregistré. Veuillez aller dans le suivi pour le modifier ou le supprimer.');
    }
        
        //dd($ppm);

        //recupération des ppm 
        $etape = 'Enreggistrement';

        
        return view('suivi_marches.create' , compact('ppm','etape'));

    }
    public function store(Request $request){
        //validate
        $message = [
            'required' => 'Le champ :attribute est obligatoire.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
            'date.after_or_equal' => 'La date ne peut pas être antérieure à aujourd\'hui.',
        ];
        $request->validate([
            'numero_marche' => 'required|max:255',
            'ligne_budgetaire' => 'required|max:255',
            'subvention' => 'required|max:255',
            'libelle_marches' => 'required|max:255',
            'mode_passation' => 'required|max:255',
            'montant_previsionnel' => 'required|max:255',
            'montant_attribution' => 'required|max:255',
            //'difference' => 'required|max:255',
            'titulaire' => 'required|max:255',
            'adresse_contact' => 'required|max:255',
            //'date_approbation' => 'required|date|after_or_equal:today',
            //'date_ordre_service' => 'required|date|after_or_equal:today',
           // 'delai_execution' => 'required|date|after_or_equal:today',
           // 'date_probable_reception' => 'required|date|after_or_equal:today',
        ], $message);

        //récupération de l'id de l'année en cours 
        $annee = Annee::where('statut', 'En cours')->first();

        //dd($request);
        //calcule
        /*

différence =Montant prévision-montant attribution
Date Probable de Réception  = 		date ordre service +14jrs
*/
        $delai_execution=$request->delai_execution;
        
        $difference = $request->montant_previsionnel - $request->montant_attribution;
        $date_probable_reception = Carbon::createFromFormat('Y-m-d', $request->date_ordre_service)->addDays($delai_execution);

        //récupération du ppms 
        $ppm = Ppm::where('id', $request->ppms_id)->first();
        //modification du statut_approbation en oui et enregistrement
        
        $suivi_marche = new SuiviMarche();
        $suivi_marche->ppms_id = $request->ppms_id;

        $suivi_marche->numero_marche = $request->numero_marche;
        $suivi_marche->annees_id = $annee->id;
        //etat_paiement
        $suivi_marche->etat_paiement = $request->etat_paiement;
        

        $suivi_marche->montant_attribution = $request->montant_attribution;
        $suivi_marche->difference = $difference;
        $suivi_marche->titulaire = $request->titulaire;
        $suivi_marche->adresse_contact = $request->adresse_contact;
        $suivi_marche->date_approbation = $request->date_approbation;
        $suivi_marche->date_ordre_service = $request->date_ordre_service;
        $suivi_marche->delai_execution = $request->delai_execution;
        $suivi_marche->date_probable_reception = $date_probable_reception;
        $suivi_marche->save();

        $ppm->statut_approbation = 'Oui';
        $ppm->save();
 
        // Redirection avec message flash de succès
        return redirect()->route('suivi_marches.index')->with('success', 'Suivi de marché créé avec succès.');
    }  
    
    
    public function show(string $id)
    {
        try {
            //$marche = SuiviMarche::findOrFail($id);
            $marche = SuiviMarche::with(['ppms', 'annee'])->find($id);

            return view('suivi_marches.show', compact('marche'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Le marché spécifié n\'existe pas.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit(string $suiviMarche)
    {
        // Récupération du suivi de marché avec ses relations 'ppms' et 'annee'
        $marche = SuiviMarche::with(['ppms', 'annee'])->find($suiviMarche);
        
        // Vérifiez si le suivi de marché existe
        if (!$marche) {
            // Gérer ici le cas où le suivi de marché n'est pas trouvé
            abort(404);
        }
    
        // Retourne la vue pour éditer un suivi de marché spécifique
        return view('suivi_marches.edit', compact('marche'));
    }
    
    public function update(Request $request, $id)
    {
        $message = [
            'required' => 'Le champ :attribute est obligatoire.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
            'date.after_or_equal' => 'La date ne peut pas être antérieure à aujourd\'hui.',
        ];
        
        $request->validate([
            'numero_marche' => 'required|max:255',
            'ligne_budgetaire' => 'required|max:255',
            'subvention' => 'required|max:255',
            'libelle_marches' => 'required|max:255',
            'mode_passation' => 'required|max:255',
            'montant_previsionnel' => 'required|max:255',
            'montant_attribution' => 'required|max:255',
            //'difference' => 'required|max:255',
            'titulaire' => 'required|max:255',
            'adresse_contact' => 'required|max:255',
            //'date_approbation' => 'required|date|after_or_equal:today',
            //'date_ordre_service' => 'required|date|after_or_equal:today',
           // 'delai_execution' => 'required|date|after_or_equal:today',
           // 'date_probable_reception' => 'required|date|after_or_equal:today',
        ], $message);

        $delai_execution=$request->delai_execution;
        $difference = $request->montant_previsionnel - $request->montant_attribution;
        $date_probable_reception = Carbon::createFromFormat('Y-m-d', $request->date_ordre_service)->addDays($delai_execution);

        $annee = Annee::where('statut', 'En cours')->first();

 
        // Logique pour mettre à jour les données après l'édition
        $suivi_marche = SuiviMarche::find($id);
        $ppms_id=$suivi_marche->ppms_id;

        $ppm = Ppm::where('id', $ppms_id)->first();

        $suivi_marche->numero_marche = $request->numero_marche;
        $suivi_marche->annees_id = $annee->id;
        $suivi_marche->etat_paiement = $request->etat_paiement;

        $suivi_marche->montant_attribution = $request->montant_attribution;
        $suivi_marche->difference = $difference;
        $suivi_marche->titulaire = $request->titulaire;
        $suivi_marche->adresse_contact = $request->adresse_contact;
        $suivi_marche->date_approbation = $request->date_approbation;
        $suivi_marche->date_ordre_service = $request->date_ordre_service;
        $suivi_marche->delai_execution = $request->delai_execution;
        $suivi_marche->date_probable_reception = $date_probable_reception;
        $ppm->statut_approbation = 'Oui';
        $ppm->save();

        $suivi_marche->save();
      //  dd($suivi_marche);
        //$suivi_marche->save();
        // Redirection avec message flash de succès
        return redirect()->route('suivi_marches.index')->with('success', 'Suivi de marché mis à jour avec succès.');



    }

    public function destroy($id)
    {
        // Logique pour supprimer une entrée

        //recupération de l'id ppms dans suivie
        $suivi_marche = SuiviMarche::find($id);
        $ppm = Ppm::where('id', $suivi_marche->ppms_id)->first();
        //modification du statut_approbation en non et enregistrement
        $ppm->statut_approbation = 'Non';
        $ppm->save();

        $message= 'Suivi de marché supprimé avec succès. Et
        le statut d\'approbation du ppm est passé à non';
        

        //supression
        $suivi_marche = SuiviMarche::find($id);
        $suivi_marche->delete();
        // Redirection avec message flash de succès
        return redirect()->route('suivi_marches.index')->with('success', $message);
    }
}
