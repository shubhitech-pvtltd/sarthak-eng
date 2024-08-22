<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Spare;
use App\Models\Availablestock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class AvailablestockController extends Controller
{
    public function index()
    {
        $machines = Machine::all();
        $spares = Spare::all();
        return view('stockinventory.availablestocklist', compact('machines', 'spares'));
    }

    public function getAvailablestocks(Request $request)
{
    try {
        $query = Availablestock::select([
                'availablestocks.id',
                'availablestocks.created_at',
                'spares.part_no',
                'spares.minimum_stock_alert',
                'availablestocks.quantity',
                'machines.model_no as machine_model',
            ])
            ->join('spares', 'availablestocks.part_id', '=', 'spares.id')
            ->join('machines', 'availablestocks.machine_id', '=', 'machines.id');

        // Apply filters
        if ($request->has('machine_id') && $request->machine_id) {
            $query->where('machines.id', $request->machine_id);
        }

        if ($request->has('part_id') && $request->part_id) {
            $query->where('spares.id', $request->part_id);
        }

        return DataTables::of($query)
            ->addColumn('action', function ($availablestock) {
                return '<button class="btn btn-sm btn-primary edit-alert" data-id="' . $availablestock->id . '">Edit</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    } catch (\Exception $e) {
        Log::error('Error fetching available stocks: ' . $e->getMessage());
        return response()->json(['error' => 'An error occurred while fetching data.'], 500);
    }
}


public function update($id, Request $request)
{
    $minStockAlert = $request->input('minimum_stock_alert');
    $availablestock = Availablestock::find($id);

    if ($availablestock) {
        $availablestock->minimum_stock_alert = $minStockAlert;
        $availablestock->save();

        $spare = Spare::find($availablestock->part_id);
        if ($spare) {
            $spare->minimum_stock_alert = $minStockAlert;
            $spare->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Spare part not found'], 404);
        }
    } else {
        return response()->json(['success' => false, 'message' => 'Stock not found'], 404);
    }
}

}
