<?php

namespace App\Http\Controllers;

use App\Models\Ppm;
use App\Models\Annee;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PpmExport;
use App\Imports\PpmImport;



class PpmController extends Controller
{
    // // Constructeur pour les permissions

    public function __construct()
    {
        $this->middleware('permission:ppm-list|ppm-create|ppm-edit|ppm-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:ppm-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ppm-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ppm-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        // Récupération des années
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
        return view('ppms.index', compact('annees'));
    }
    
    public function export(Request $request)
    {
        $subvention = null;
        $annee_id = $request->input('annee');
    
        if ($annee_id == null) {
            $annee_id = 1;
        }
    
        $annee = Annee::find($annee_id);
        $libelle_annee = $annee ? $annee->libelle : '';
    
        if ($request->subvention == "Subvention PALU") {
            $subvention = "Subvention PALU";
        } elseif ($request->subvention == "Subvention VIH") {
            $subvention = "Subvention VIH";
        } elseif ($request->subvention == "Subvention C19RM") {
            $subvention = "Subvention C19RM";
        } elseif ($request->subvention == "Subvention TB") {
            $subvention = "Subvention TB";
        }
    
        return Excel::download(new PpmExport($subvention, $annee_id, $libelle_annee), 'ppms.xlsx');
    }
    
    

    /**
     * Importe les nationalités à partir d'un fichier Excel.
     */
    public function import(Request $request)
    {
        $messages = [
            'file.required' => 'Le fichier est obligatoire.',
            'file.mimes' => 'Le fichier doit être un fichier de type :values.',
            //requier
            'subvention.required' => 'Le champ :attribute est obligatoire.',
        ];
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,ods',
            //Subvention
            'subvention' => 'required|max:255',
            'annee'  => 'required',

        ], $messages);
     //   dd($request);
     //recupération de l'anne
     $annee_id = $request->input('annee');
     $subvention = $request->input('subvention');
     $file = $request->file('file');
 
     try {
         Excel::import(new PpmImport($subvention, $annee_id), $file);
     } catch (\Exception $e) {
         dd($e->getMessage());
     }
 

        return redirect()->route('ppm.index')->with('success', 'Données de ppms importées avec succès.');
    }


    public function create()
    {
        $annees = Annee::all();
        return view('ppms.create', compact('annees'));

        //return view('ppms.create');
    }

    public function store(Request $request)
    {
        $message = [
            'required' => 'Le champ :attribute est obligatoire.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
            'date.after_or_equal' => 'La date ne peut pas être antérieure à aujourd\'hui.',
        ];

        $request->validate([
            'ligne_budgetaire' => 'required|max:255',
            //description_fiurniture_traveaux
            'libelle_marches' => 'required|max:255',
            'mode_passation' => 'nullable|string|max:255',
            'trimestre_sortie_fonds',
            'montant_previsionnel' => 'nullable|numeric',
            'subvention' => 'required|string',



            
        ], $message);

        $ppm = new Ppm();
        $ppm->subvention = $request->subvention;

        $ppm->ligne_budgetaire = $request->input('ligne_budgetaire');
        $ppm->libelle_marches = $request->input('libelle_marches');
        $ppm->mode_passation = $request->input('mode_passation');
        $ppm->trimestre_sortie_fonds = $request->input('trimestre_sortie_fonds');
        $ppm->montant_previsionnel = $request->input('montant_previsionnel');

        
        $ppm->save();

        return redirect()->route('ppm.index')->with('success', 'PPM ajouté avec succès.');
    }

    public function show(string $id)
    {
        try {
            $ppm = Ppm::findOrFail($id);
            return view('ppms.show', compact('ppm'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Le PPM spécifié n\'existe pas.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {

        $ppm = Ppm::findOrFail($id);
        $annees = Annee::all();

        //return
        return view('ppms.edit', compact('ppm', 'annees'));

       // return view('ppms.edit', compact('ppm'));
    }
    public function update(Request $request, Ppm $ppm)
    {
        $message = [
            'required' => 'Le champ :attribute est obligatoire.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
            'date.after_or_equal' => 'La date ne peut pas être antérieure à aujourd\'hui.',
        ];
    
        $request->validate([
            'ligne_budgetaire' => 'required|max:255',
            //annee
            'annee' => 'required|max:255',
            
            'libelle_marches' => 'required|max:255',
            'mode_passation' => 'nullable|string|max:255',
            'trimestre_sortie_fonds' => 'nullable|string|max:255',
            'montant_previsionnel' => 'nullable|numeric',
        ], $message);
    
        $ppm->subvention = $request->subvention;
        $ppm->id_annee = $request->annee;

        $ppm->ligne_budgetaire = $request->input('ligne_budgetaire');
        $ppm->libelle_marches = $request->input('libelle_marches');
        $ppm->mode_passation = $request->input('mode_passation');
        $ppm->trimestre_sortie_fonds = $request->input('trimestre_sortie_fonds');
        $ppm->montant_previsionnel = $request->input('montant_previsionnel');
    
        $ppm->save();
    
        return redirect()->route('ppm.index')->with('success', 'PPM mis à jour avec succès.');
    }
    

    public function destroy(string $id)
    {
        try {
            $ppm = Ppm::findOrFail($id);
            $ppm->delete();

            return redirect()->route('ppms.index')->with('success', 'PPM supprimé avec succès.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Le PPM spécifié n\'existe pas.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
