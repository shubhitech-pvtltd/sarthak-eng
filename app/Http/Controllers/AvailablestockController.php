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

    public function getAvailablestocks()
    {
        try {
            $availablestocks = Availablestock::select([
                'availablestocks.id',
                'availablestocks.created_at',
                'spares.part_no',
                'availablestocks.discription',
                'spares.minimum_stock_alert',
                'spares.quantity',
                'spares.part_no',
                'machines.model_no as machine_model',
            ])
            ->join('spares', 'availablestocks.part_id', '=', 'spares.id')
            ->join('machines', 'spares.machine_id', '=', 'machines.id');


            return DataTables::of($availablestocks)
                ->addColumn('action', function ($availablestock) {
                    return '
                        <div class="dropdown">

                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error fetching available stocks: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching data.'], 500);
        }
    }

public function getData(Request $request)
{
    $query = Availablestock::query();

    if ($request->has('machine_id') && $request->machine_id) {
        $query->where('machine_id', $request->machine_id);
    }

    if ($request->has('part_id') && $request->part_id) {
        $query->where('part_id', $request->part_id);
    }

    return datatables()->of($query)->make(true);
}

public function updateStockAlert(Request $request, $id)
{
    $request->validate([
        'minimum_stock_alert' => 'required|integer'
    ]);

    $stock = Availablestock::find($id);
    if ($stock) {
        $stock->minimum_stock_alert = $request->input('minimum_stock_alert');
        $stock->save();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}


}
