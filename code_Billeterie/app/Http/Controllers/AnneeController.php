<?php

namespace App\Http\Controllers;
use App\Models\Annee;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnneeController extends Controller
{
 // Constructeur pour les permissions
    public function __construct()
    {
        $this->middleware('permission:annee-list|annee-create|annee-edit|annee-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:annee-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:annee-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:annee-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $data = Annee::query();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '
                    <div class="d-flex gap-2">
                        <a href="' . route('annees.edit', $row->id) . '" class="btn btn-sm btn-outline-info">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="' . route('annees.show', $row->id) . '" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-eye"></i>
                        </a>
                        <form action="' . route('annees.destroy', $row->id) . '" method="POST" class="d-inline">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-outline-danger delete-btn">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('annees.index');
    }

    public function create()
    {
        return view('annees.create');
    }

    public function store(Request $request)
    {
      // Messages d'erreur personnalisés
        $messages = [
            'required' => 'Le champ :attribute est obligatoire.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
            'date' => 'Le champ :attribute doit être une date valide.',
            'date.after_or_equal' => 'La date ne peut pas être antérieure à aujourd\'hui.',
            'libelle.unique' => 'Année doit être unique.',
        ];

        // Règles de validation
        $request->validate([
            'libelle' => 'required|string|max:255|unique:annees,libelle',
            'description' => 'nullable|string',
            'statut' => 'nullable|string', // Vous pouvez définir des règles plus spécifiques si nécessaire
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date',
        ], $messages);

        
        //vérifier si il y'a une anné en cours si non renvoyer vers la page index aevec un message 
        //sinon créer une nouvelle année
     
       // dd($request);

        $annee = new Annee();
        $annee->libelle = $request->libelle;
        $annee->description = $request->description;
        $annee->statut = $request->statut;
        $annee->date_debut = $request->date_debut;
        $annee->date_fin = $request->date_fin;
        $annee->save();

        return redirect()->route('annees.index')->with('success', 'Année créée avec succès.');
    }

    public function edit($id)
    {
        $annee = Annee::find($id);
        return view('annees.edit', compact('annee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'statut' => 'required|string|max:255',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date',
        ]);

        $annee = Annee::find($id);
        $annee->libelle = $request->libelle;
        $annee->description = $request->description;
        $annee->statut = $request->statut;
        $annee->date_debut = $request->date_debut;
        $annee->date_fin = $request->date_fin;
        $annee->save();

        return redirect()->route('annees.index')->with('success', 'Année mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $annee = Annee::find($id);
        $annee->delete();

        return redirect()->route('annees.index')->with('success', 'Année supprimée avec succès.');
    }
}
