<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::with('event'); 

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $fromDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
                $toDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
    
                $data->whereBetween('created_at', [$fromDate, $toDate]);
            }
    
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('orders.destroy', $row->order_id);
                    
                    return '
                        <div class="d-flex gap-2">
                           
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
                ->addColumn('event_title', function ($row) {
                    return $row->event->event_title ?? 'N/A';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('orders.index');
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Commande supprimée avec succès.');
    }
}
