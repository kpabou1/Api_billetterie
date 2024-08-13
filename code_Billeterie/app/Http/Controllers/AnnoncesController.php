<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Sourcefinance;
use App\Models\User;
use App\Models\Categoriefinance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Exception;


class AnnoncesController extends Controller
{

    /*
    public function __construct()
    {
    $this->middleware('permission:annonce-list|annonce-create|annonce-edit|annonce-delete', ['only' => ['index','show']]);
    $this->middleware('permission:annonce-create', ['only' => ['create','store']]);
    $this->middleware('permission:annonce-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:annonce-delete', ['only' => ['destroy']]);
    }
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Annonce::query();

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
                $toDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();

                $data->whereBetween('created_at', [$fromDate, $toDate]);
            }

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-sm btn-info">Détails</button>';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('annonces.index');
    }

    public function create()
    {

        $sourcefinances= Sourcefinance::all();

        
        return view('annonces.create',compact('sourcefinances'));
    }

    public function store(Request $request)
    {
        $message = [
            'required' => 'Le champ :attribute est obligatoire.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max kilo-octets.',
            'date.required' => 'Le champ date est obligatoire.',
            'date.after_or_equal' => 'La date ne peut pas être antérieure à aujourd\'hui.',
            'am_pm.required' => 'Vous devez choisir AM ou PM.', // Message personnalisé pour AM/PM
            'autres.required' => 'Quand vous choisiser autres vous devez obligatoirement remplire le champ autres  en donnant votre source de financement', // Message personnalisé pour AM/PM
            'categoriefinance_id.required' => 'Quand vous choisiser Partenaire technique et financie vous devez obligatoirement choisire la catégorie', // Message personnalisé pour AM/PM

        ];

       // dd($request);

        $request->validate([
            'objet_marche' => 'required|string|max:255',
            'sourcesfinance' => 'required',
            'garantie_soumission' => 'required|string|max:255',
            'nom_autorite_contractante' => 'required',
            'corps_annonce' => 'required',


            'adresse_autorite_contractante' => 'required|string|max:255',
            'lieu_depot' => 'required|string|max:255',
            'description' => 'nullable|string',

            'ficher_annonce' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:504800',
            'date_cloture' => 'required|date|after_or_equal:today', // Validation pour la date

        ], $message);
        //faire un validate au cas ou on upload image_autorite_contractante
        
        
        if ($request->input('sourcesfinance') ==2) {


            $this->validate($request, [
                'categoriefinance_id' => 'required',

            ], $message);

        }
        
        if ($request->input('sourcesfinance') ==3) {


            $this->validate($request, [
                'autres' => 'required',

            ], $message);

        }


        //dd($request);
        if ($request->hasFile('ficher_annonce')) {
            $ficherPath = $request->file('ficher_annonce')->store('annonces', 'public');
        } else {
            $ficherPath = null;
        }
        if ($request->hasFile('image_autorite_contractante')) {
            $ImagePath = $request->file('image_autorite_contractante')->store('annonces', 'public');
        } else {
            $ImagePath = null;
        }

      


        //recupération de l'user connecté
        $user = Auth::user();
        if ($user) {
            $user_id = $user->id;
            // Your code here
        } else {

            Session::flash('success', 'Erreur.');
            return redirect()->route('annonces.index');

        }

    // Création de l'annonce  sourcesfinance
        $annonce = new Annonce();
        $annonce->user_id = $user_id;
        $annonce->objet_marche = $request->input('objet_marche');
        $annonce->garantie_soumission = $request->input('garantie_soumission');
        $annonce->corps_annonce = $request->input('corps_annonce');

        $annonce->adresse_autorite_contractante = $request->input('adresse_autorite_contractante');
        $annonce->lieu_depot = $request->input('lieu_depot');
        $annonce->description = $request->input('description');
        $annonce->autres_source = $request->input('autres');

        $annonce->sourcesfinance_id = $request->input('sourcesfinance');
        $annonce->nom_autorite_contractante = $request->input('nom_autorite_contractante');

        $annonce->image_autorite_contractante = $ImagePath;
        $annonce->sourcesfinance_autres = $request->input('categoriefinance_id');
        $annonce->categorie_source_id = $request->input('categoriefinance_id');




        $annonce->date_depot = $request->input('date_depot');
        
        $annonce->ficher_annonce = $ficherPath;
        $annonce->date_cloture = $request->input('date_cloture'); // Assigner la date à l'annonce

        $annonce->save();

        Session::flash('success', 'Annonce ajoutée avec succès.');
        return redirect()->route('annonces.index');
    }



    public function show(string $id)
    {
 

        try {
            // Récupération de l'annonce
            $annonce = Annonce::with(['user', 'sourcefinance', 'categoriefinance'])->findOrFail($id);
            //recherche du name de sourcefinance
            $sourcefinance = Sourcefinance::findOrFail($annonce->sourcesfinance_id);
            //si source finance id ==3
            if ($annonce->sourcesfinance_id == 2) {

                //recherche de catégorie
                $sourcefinance = Categoriefinance::findOrFail($annonce->categorie_source_id);
                $sourcefinance = $sourcefinance->name;
               
            }
            elseif($annonce->sourcesfinance_id == 3) {
                $sourcefinance = $annonce->autres_source;
            }

            /*
            else{
                $sourcefinance = $annonce->autres_source;
            }
                */
          //  dd($sourcefinance);
           
            return view('annonces.show', compact('annonce','sourcefinance'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // L'annonce n'a pas été trouvée
            return redirect()->back()->with('error', 'L\'annonce spécifiée n\'existe pas.');

        } catch (Exception $e) {
            // Autres erreurs
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }


    public function edit(string $id)
    {   $sourcefinance= Sourcefinance::all();
        //dd($sourcefinance[2]->id);

        $annonce = Annonce::findOrFail($id);
        //dd($annonce->sourcesfinance_id);
        //dd($annonce->sourcesfinance_id ==$sourcefinance[2]->id );
       // dd($annonce);
        return view('annonces.edit', compact('annonce', 'sourcefinance'));
    }

    public function update(Request $request, string $id)
    {
        $message = [
            'required' => 'Le champ :attribute est obligatoire.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max kilo-octets.',
            'date.required' => 'Le champ date est obligatoire.',
            'date.after_or_equal' => 'La date ne peut pas être antérieure à aujourd\'hui.',
            'am_pm.required' => 'Vous devez choisir AM ou PM.', // Message personnalisé pour AM/PM
            'autres.required' => 'Quand vous choisiser autres vous devez obligatoirement remplire le champ autres  en donnant votre source de financement', // Message personnalisé pour AM/PM
            'categoriefinance_id.required' => 'Quand vous choisiser Partenaire technique et financie vous devez obligatoirement choisire la catégorie', // Message personnalisé pour AM/PM

        ];


        $request->validate([
            'objet_marche' => 'required|string|max:255',
            'sourcesfinance' => 'required',
            'garantie_soumission' => 'required|string|max:255',
            'nom_autorite_contractante' => 'required',

            'adresse_autorite_contractante' => 'required|string|max:255',
            'lieu_depot' => 'required|string|max:255',
            'description' => 'nullable|string',

           // 'ficher_annonce' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:504800',
            'date_cloture' => 'required|date|after_or_equal:today', // Validation pour la date

        ], $message);

        if ($request->input('sourcesfinance') ==2) {


            $this->validate($request, [
                'categoriefinance_id' => 'required',

            ], $message);

        }
        
        if ($request->input('sourcesfinance') ==3) {


            $this->validate($request, [
                'autres' => 'required',

            ], $message);

        }

        $annonce = Annonce::findOrFail($id);

        if ($request->hasFile('ficher_annonce')) {
            $ficherPath = $request->file('ficher_annonce')->store('annonces', 'public');
            $annonce->ficher_annonce = $ficherPath;
        }

        if ($request->hasFile('image_autorite_contractante')) {
            $ImagePath = $request->file('image_autorite_contractante')->store('annonces', 'public');
            $annonce->image_autorite_contractante = $ImagePath;
        }

                              // dd($request->input('categoriefinance_id'));

        $annonce->update([
            'objet_marche' => $request->input('objet_marche'),
            'garantie_soumission' => $request->input('garantie_soumission'),
            'adresse_autorite_contractante' => $request->input('adresse_autorite_contractante'),
            'lieu_depot' => $request->input('lieu_depot'),
            'description' => $request->input('description'),
            'sourcesfinance_id' => $request->input('sourcesfinance_id'),
            'date_depot' => $request->input('date_depot'),
            'nom_autorite_contractante' => $request->input('nom_autorite_contractante'),
            'autres_source' => $request->input('autres'),
            'categorie_source_id' => $request->input('categoriefinance_id'),


            'date_cloture' =>$request->input('date_cloture'),
        ]);
        //dd($request->input('categoriefinance_id'));
        //dd($annonce);


        Session::flash('success', 'Annonce mise à jour avec succès.');
        return redirect()->route('annonces.index');
    }

    public function destroy(string $id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();

        return redirect()->route('annonces.index')->with('success', 'Annonce supprimée avec succès.');
    }
}
