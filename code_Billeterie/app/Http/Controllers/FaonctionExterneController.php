<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Categoriefinance;
use App\Models\Sourcefinance;

use Exception;

class FaonctionExterneController extends Controller
{
 



    public function getAnnonceDetails($id)
    {
        $annonce = Annonce::find($id);

        if (!$annonce) {
            return response()->json(['message' => 'Annonce not found'], 404);
        }

        $data = [
            'annonces' => $annonce,
            'reponse' => 'Liste des annonces'
        ];

        return response()->json($data);
    }



    

public function filter_annonce(Request $request)
{
    try {
        \Log::info('filter_annonce called with parameters', $request->all());

        $query = Annonce::query();

        if ($request->has('sourceFinancement')) {
            \Log::info('Filtering by sourceFinancement: ' . $request->sourceFinancement);
            $query->where('sourcesfinance_id', $request->sourceFinancement);
        }
        if ($request->has('categorieFinancement')) {
            \Log::info('Filtering by categorieFinancement: ' . $request->categorieFinancement);
            $query->where('categorie_source_id', $request->categorieFinancement);
        }

        if ($request->has('autreSource') && !empty($request->autreSource)) {
            \Log::info('Filtering by autreSource: ' . $request->autreSource);
            $query->where('autres_source', 'LIKE', '%' . $request->autreSource . '%');
        }

        if ($request->has('datePublication')) {
            \Log::info('Filtering by datePublication: ' . $request->datePublication);
            switch ($request->datePublication) {
                case '1mois':
                    $query->where('created_at', '>=', now()->subMonth());
                    break;
                case '3mois':
                    $query->where('created_at', '>=', now()->subMonths(3));
                    break;
                case '1ans':
                    $query->where('created_at', '>=', now()->subYear());
                    break;
               
                default:
                    \Log::warning('Unknown datePublication filter: ' . $request->datePublication);
            }
        }
         // Filtrage par date de clôture
        if ($request->has('date_cloture')) {
            $query->whereDate('date_cloture', '>=', $request->date_cloture);
        }
        

        if ($request->has('nom_autorite_contractante') && !empty($request->nom_autorite_contractante)) {
            \Log::info('Filtering by nom_autorite_contractante: ' . $request->nom_autorite_contractante);
            $query->where('nom_autorite_contractante', 'LIKE', '%' . $request->nom_autorite_contractante . '%');
        }

        $annonces = $query->orderBy('created_at', 'desc')->get();

        \Log::info('Annonces retrieved successfully', ['count' => $annonces->count()]);

        return response()->json($annonces);
    } catch (\Exception $e) {
        \Log::error('Error in filter_annonce: ' . $e->getMessage());
        return response()->json(['error' => 'An error occurred while fetching annonces.'], 500);
    }
}


    public function getAnnonces()
    {
        $annonces = Annonce::all();
        $data = [
            'annonces' => $annonces,
            'reponse' => 'Liste des annonces'
        ];
        return response()->json($data);

    }

    public function getCategories(){
        $categories = Categoriefinance::all();
       // $categories = Categoriefinance::where('sourcesfinance_id', $id)->get();
        $data = [
            'categories' => $categories,
            'reponse' => 'Liste des catégories'
        ];
        return response()->json($data);
    
    }

    public function getCategoryFind($id){
       // $categorie = Categoriefinance::find($id);
        $categories = Categoriefinance::where('sourcesfinance_id', $id)->get();

        if (!$categories) {
            return response()->json(['message' => 'Categorie not found'], 404);
        }
        $data = [
            'categorie' => $categories,
            'reponse' => 'Catégorie trouvée'
        ];
        return response()->json($data);
    }


    public function showAnnonce(string $id)
    {


        try {
            // Récupération de l'annonce
            $annonce = Annonce::with(['user', 'sourcefinance', 'categoriefinance'])->findOrFail($id);
            //recherche du name de sourcefinance
            $sourcefinance = Sourcefinance::findOrFail($annonce->sourcesfinance_id);
            $sourcefinance = $sourcefinance->name;
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
           
            return view('fonction_externes.showannonce', compact('annonce','sourcefinance'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // L'annonce n'a pas été trouvée
            return redirect()->back()->with('error', 'L\'annonce spécifiée n\'existe pas.');

        } catch (Exception $e) {
            // Autres erreurs
            return redirect()->back()->with('error', $e->getMessage());
        }
        
        
    }


}
