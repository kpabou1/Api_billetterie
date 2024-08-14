<?php

namespace App\Http\Controllers;

use App\Models\Event;
//Event
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function __construct()
    {
    $this->middleware('permission:events-list|events-create|events-edit|events-delete', ['only' => ['index','show']]);
    $this->middleware('permission:events-create', ['only' => ['create','store']]);
    $this->middleware('permission:events-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:events-delete', ['only' => ['destroy']]);
    }
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::query();
    
            if ($request->filled('from_date') && $request->filled('to_date')) {
                $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
                $toDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
    
                $data->whereBetween('created_at', [$fromDate, $toDate]);
            }
    
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editUrl = route('events_billets.edit', $row->event_id);
                    $showUrl = route('events_billets.show', $row->event_id);
                    $deleteUrl = route('events_billets.destroy', $row->event_id);
                    
                    return '
                        <div class="d-flex gap-2">
                            <a href="'.$editUrl.'" class="btn btn-sm btn-outline-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="'.$showUrl.'" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <form action="'.$deleteUrl.'" method="POST" class="d-inline">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-outline-danger delete-btn">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    ';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('events.index');
    }
    
    public function create()
    {

        return view('events.create');

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_category' => 'required|string',
            'event_title' => 'required|string|max:30',
            'event_description' => 'nullable|string',
            'event_date' => 'required|date',
            'event_image' => 'required|image|max:2048',
            'event_city' => 'required|string|max:100',
            'event_address' => 'required|string|max:200',
            'ticket_type_name' => 'required|array',
            'ticket_type_name.*' => 'required|string|max:50',
            'ticket_type_price' => 'required|array',
            'ticket_type_price.*' => 'required|integer',
            'ticket_type_quantity' => 'required|array',
            'ticket_type_quantity.*' => 'required|integer',
            'ticket_type_description' => 'nullable|array',
            'ticket_type_description.*' => 'nullable|string',
            'ticket_type_real_quantity' => 'required|array',
            'ticket_type_real_quantity.*' => 'required|integer',
        ]);

        // Handle file upload
        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('event_images', 'public');
            $validatedData['event_image'] = $imagePath;
        }
        //event_date
        //on vérifie si la event_date est déjà passé on change sa en fonction des status ici
        $event_date = Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['event_date']);
        $event_status = $event_date->isPast() ? 'completed' : 'upcoming';
        $validatedData['event_status'] = $event_status;

        //dd($request);

        // Create event
        $event = Event::create($validatedData);
        
        //calucul de la spmmes des deux quantité   ticket_type_real_quantity + ticket_type_real_quantity

        // Calcul de la quantité totale de tickets
        $total_quantity = array_sum($validatedData['ticket_type_real_quantity']);

        // Create ticket types
        foreach ($validatedData['ticket_type_name'] as $index => $name) {
            $event->ticketTypes()->create([
                'ticket_type_name' => $name,
                'ticket_type_price' => $validatedData['ticket_type_price'][$index],
                'ticket_type_quantity' => $validatedData['ticket_type_quantity'][$index],
                'ticket_type_description' => $validatedData['ticket_type_description'][$index] ?? '',
                'ticket_type_real_quantity' => $validatedData['ticket_type_real_quantity'][$index],
                'ticket_type_total_quantity' => $validatedData['ticket_type_real_quantity'][$index], // Calcul correct de la quantité totale
            ]);
        }

        return redirect()->route('events_billets.index')->with('success', 'Événement créé avec succès');
    }



    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'event_category' => 'required|string',
            'event_title' => 'required|string|max:30',
            'event_description' => 'nullable|string',
            'event_date' => 'required|date',
            'event_image' => 'nullable|image|max:2048',
            'event_city' => 'required|string|max:100',
            'event_address' => 'required|string|max:200',
            'ticket_type_name' => 'required|array',
            'ticket_type_name.*' => 'required|string|max:50',
            'ticket_type_price' => 'required|array',
            'ticket_type_price.*' => 'required|integer',
            'ticket_type_quantity' => 'required|array',
            'ticket_type_quantity.*' => 'required|integer',
            'ticket_type_description' => 'nullable|array',
            'ticket_type_description.*' => 'nullable|string',
            'ticket_type_real_quantity' => 'required|array',
            'ticket_type_real_quantity.*' => 'required|integer',
        ]);

        $event = Event::findOrFail($id);

        // Handle file upload if a new image is provided
        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('event_images', 'public');
            $validatedData['event_image'] = $imagePath;
        }

        // Update event status based on date
        $event_date = Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['event_date']);
        $event_status = $event_date->isPast() ? 'completed' : 'upcoming';
        $validatedData['event_status'] = $event_status;

        // Update event
        $event->update($validatedData);

        // Update ticket types
        $event->ticketTypes()->delete(); // Delete old ticket types
        foreach ($validatedData['ticket_type_name'] as $index => $name) {
            $event->ticketTypes()->create([
                'ticket_type_name' => $name,
                'ticket_type_price' => $validatedData['ticket_type_price'][$index],
                'ticket_type_quantity' => $validatedData['ticket_type_quantity'][$index],
                'ticket_type_description' => $validatedData['ticket_type_description'][$index] ?? '',
                'ticket_type_real_quantity' => $validatedData['ticket_type_real_quantity'][$index],
                'ticket_type_total_quantity' => $validatedData['ticket_type_real_quantity'][$index],
            ]);
        }

        return redirect()->route('events_billets.index')->with('success', 'Événement mis à jour avec succès');
    }

    public function destroy($id)
    {
      
        $event = Event::findOrFail($id);
        $event->delete();
      //  dd('a');

        return redirect()->route('events_billets.index')->with('success', 'Événement supprimé avec succès');
    }

}
