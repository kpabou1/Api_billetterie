<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
//Event
use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */




    public function filter_evenements(Request $request)
    {
        try {
            \Log::info('filter_evenements called with parameters', $request->all());
    
            $query = Event::query();
    
            // Filtrage par statut de l'événement
            if ($request->has('eventStatus')) {
                $eventStatus = $request->get('eventStatus');
    
                if ($eventStatus === 'upcoming') {
                    $query->where('event_status', '==', 'upcoming');
                }
                else{
                    $query->where('event_status', '!=', 'past');

                }
            }
    
            // Récupération des événements filtrés
            $events = $query->orderBy('created_at', 'desc')->get();
    
            \Log::info('Events retrieved successfully', ['count' => $events->count()]);
    
            return response()->json($events);
        } catch (\Exception $e) {
            \Log::error('Error in filter_evenements: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching events.'], 500);
        }
    }
    

    public function getTicketsByEvent($eventId)
    {
        try {
            $tickets = TicketType::where('ticket_type_event_id', $eventId)->get();
            return response()->json($tickets);
        } catch (\Exception $e) {
            \Log::error('Error retrieving tickets: ' . $e->getMessage());
            return response()->json(['error' => 'Une erreur est survenue lors de la récupération des types de tickets.'], 500);
        }
    }
    
}
