<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\TicketType;

use Exception;

class FaonctionExterneController extends Controller
{
 
    public function welcome()
    {
        // Récupération de tous les événements
        $events = Event::orderBy('created_at', 'desc')->paginate(9);

        return view('Aceuil.welcome', compact('events'));
    }

    public function listeEvents()
    {
        // Récupération de tous les événements
        $events = Event::orderBy('created_at', 'desc')->paginate(9);

        return view('Aceuil.welcome_events', compact('events'));
    }


    // TicketController.php
    public function showPaymentPage($ticketId, Request $request)
    {
    
      //  dd("En cours de taff");
        dd($request);
        $ticket = TicketType::findOrFail($ticketId);
        return view('payment.show', compact('ticket'));
    }

    





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
