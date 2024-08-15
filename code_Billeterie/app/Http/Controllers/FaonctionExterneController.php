<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\TicketType;
use App\Models\OrderIntent;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Str;
use PDF;


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
        $tickets = TicketType::where('ticket_type_id', $ticketId)->get();
        
        //recupéraion de ticket_type_event_id
        $ticket_type_event_id = $tickets[0]->ticket_type_event_id;
        //recupération de l'event
        $event = Event::findOrFail($ticket_type_event_id);
        //venvoie vers la page d'enregistrement d'information du client
        return view('Aceuil.infos_payment', compact('tickets', 'event'));
      
    }
    //processPaymentInfo
    public function processPaymentInfo(Request $request)
    {    
        
        //je recupère le id du ticket
        $ticketId = $request->ticket_type_id;
        
        //je recupère le nombre de ticket qu'il veux
        $ticket_quantity = $request->order_intent_nombre;
        $user_phone = $request->user_phone;

        //recupère le ticket en question
        $ticket = TicketType::findOrFail($ticketId);

        //je caluctule le prix totale de la commande en fesant  le nom fois le prix
        $total_price = $ticket->ticket_type_price * $ticket_quantity;
        //je recupère l'email de l'user connecté auth
        $email = auth()->user()->email;
        //je créer un nouveau OrderIntent
        //je créer un délais d'expiration de type datetime en crecupérant la date actuel + 48 heure
        $expiration = now()->addHours(48);

        $expiration = now()->addHours(48);

        // Affectez la date formatée (Y-m-d H:i:s) à une variable
        $expirationFormatted = $expiration->format('Y-m-d H:i:s');

        $orderIntent = new OrderIntent();
        //je remplie les champs
        $orderIntent->user_email = $email;
        $orderIntent->user_phone = $user_phone;
        $orderIntent->order_intent_type = $request->order_intent_type;
        $orderIntent->order_intent_price = $total_price;
        $orderIntent->expiration_date = $expirationFormatted;

        //je sauvegarde
        $orderIntent->save();
        $orderIntentId=$orderIntent->order_intent_id;
        //jajoute dans la session le nombre de tickets choisie et le et le num ticket
       // $request->session()->put('orderIntentId', $orderIntent->order_intent_id);
        //$request->session()->put('ticket_quantity', $ticket_quantity);
        /*
        //je les recupère
        $ticket_quantity = $request->session()->get('ticket_quantity');
        $orderIntentId = $request->session()->get('orderIntentId');
        */
        //je redirige vers la page de paiement confirme  avec le nombre de ticket choisie puis et le num ticket Route::get('/paymentconfirm/{ticketId}', [FaonctionExterneController::class, 'showPaymentConfirmPage'])->name('payment.confirm');
        return redirect()->route('payment.showconfirm', [
            'ticketId' => $ticketId, 
            'ticket_quantity' => $ticket_quantity, 
            'orderIntentId' => $orderIntentId
        ]);
        


    }
    public function showPaymentConfirmPage($ticketId, Request $request,$ticket_quantity, $orderIntentId)
    {
        
       
      
        //je recupère le ticket
        $ticket = TicketType::findOrFail($ticketId);
        //je recupère le prix total
        $total_price = $ticket->ticket_type_price * $ticket_quantity;
        //je recupère la commande
        $orderIntent = OrderIntent::findOrFail($orderIntentId);
        //je recupère l'event
        $event = Event::findOrFail($ticket->ticket_type_event_id);
        //je renvoie vers la page de paiement confirme
        return view('Aceuil.payment_confirm', compact('ticket', 'ticket_quantity','ticketId', 'total_price', 'orderIntent', 'event'));
    }


    




    public function processPaymentConfirm(Request $request)
    {
      
        //je recupère le ticket
        $ticket = TicketType::findOrFail($request->ticket_type_id);
        //je recupère le order_intent_id
        $orderIntentId = $request->order_intent_id;
        //je recupère le nombre de ticket
        $orderIntent = OrderIntent::findOrFail($orderIntentId);
        //préparation de l'enregistrement du payement
        //génération d'un unique de 9 chiffre et lettre tout en vérifiant dans la table oders
       
        do {
            $key = Str::random(9);
            $key = strtoupper($key);
            $key = 'TICKET-' . $key;

        } while (Order::where('order_number', $key)->exists());
        //ticket_event_id
        $ticket_event_id = $ticket->ticket_type_event_id;

        $order_number=$key;
        //je récupère le prix totale
        $order_price = $orderIntent->order_intent_price;
        //je recupère order_type
        $order_type = $orderIntent->order_intent_type;
        //order_payment
        $order_payment = $request->order_payment;
        //ticket_email
        $ticket_email = $request->ticket_email;
        //ticket_phone
        $ticket_phone = $request->ticket_phone;
        //ticket_quantity
        $ticket_quantity = $request->ticket_quantity;
        //ticket_order_id


      
        //ticket_ticket_type_id
        $ticket_ticket_type_id = $ticket->ticket_type_id;

        //création de orders
        $orders = new Order();
        $orders->order_number = $order_number;
        $orders->order_event_id = $ticket_event_id;
        $orders->order_price = $order_price;
        $orders->order_type = $order_type;
        $orders->order_payment = $order_payment;
        $orders->save();
        $ticket_order_id = $orders->order_id;


        //création de ticket
        $ticket = new Ticket();
        $ticket->ticket_event_id = $ticket_event_id;
        $ticket->ticket_email = $ticket_email;
        $ticket->ticket_phone = $ticket_phone;
        $ticket->ticket_quantity = $ticket_quantity;
        $ticket->ticket_order_id = $ticket_order_id;
        $ticket->ticket_key = $key;
        $ticket->ticket_ticket_type_id = $ticket_ticket_type_id;
        $ticket->ticket_status = 'active';
        $ticket->save();
        //je redirige vers la page de téléchargement de ticket
        //tableau d'information nécéssaire pour le ticket
        return redirect()->route('ticket.download', [
            'ticket_id' => $ticket->ticket_id,
                'ticket_key' => $ticket->ticket_key,
                'ticket_email' => $ticket->ticket_email,
                'ticket_phone' => $ticket->ticket_phone,
                'ticket_quantity' => $ticket->ticket_quantity,
                'ticket_order_id' => $ticket->ticket_order_id,
                'ticket_ticket_type_id' => $ticket->ticket_ticket_type_id,
                'ticket_status' => $ticket->ticket_status,
            ]);
            
    

      

       

    }


    public function downloadTicket(Request $request)
    {
        $ticket = [
            'ticket_id' => $request->ticket_id,
            'ticket_key' => $request->ticket_key,
            'ticket_email' => $request->ticket_email,
            'ticket_phone' => $request->ticket_phone,
            'ticket_quantity' => $request->ticket_quantity,
            'ticket_order_id' => $request->ticket_order_id,
            'ticket_ticket_type_id' => $request->ticket_ticket_type_id,
            'ticket_status' => $request->ticket_status,
        ];

      //  return $pdf->download('ticket.pdf');
      $pdf = PDF::loadView('tickets.pdf', compact('ticket'));
      return $pdf->stream('ticket.pdf');
    }



}
