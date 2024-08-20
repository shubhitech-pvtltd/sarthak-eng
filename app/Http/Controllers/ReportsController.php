<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Spare;
use App\Models\Incomingstock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class ReportsController extends Controller
{
    public function index()
    {
        $machines = Machine::all();
        $spares = Spare::all();
        return view('stockinventory.reports', compact('machines', 'spares'));
    }

    public function viewReport()
{
    $incomingstocks = Incomingstock::select([
        'incomingstocks.id',
        'incomingstocks.date',
        'incomingstocks.rack_no',
        'incomingstocks.carrot_no',
        'incomingstocks.description',
        'incomingstocks.quantity',
        'incomingstocks.unit',
        'spares.part_no',
        'incomingstocks.stock_in_hand',
        'machines.model_no as machine_model',
    ])
    ->join('spares', 'incomingstocks.part_id', '=', 'spares.id')
    ->join('machines', 'spares.machine_id', '=', 'machines.id');

    return DataTables::of($incomingstocks)
        ->addColumn('action', function ($incomingstock) {
            return '
                <div class="dropdown">
                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="'.url('/stockinventory/incomingstock/'.$incomingstock->id.'/edit').'"><i class="fa fa-pencil"></i> Edit</a>
                        <a class="dropdown-item deleteBtn" data-url="'.url('/stockinventory/incomingstock/'.$incomingstock->id).'"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';
        })
        ->rawColumns(['action'])
        ->make(true);
}
public function getData(Request $request)
{
    $query = IncomingStock::query();

    if ($request->has('machine_id') && $request->machine_id) {
        $query->where('machine_id', $request->machine_id);
    }

    if ($request->has('part_id') && $request->part_id) {
        $query->where('part_id', $request->part_id);
    }

    return datatables()->of($query)->make(true);
}

  public function getIncomingstockDetails(Request $request)
    {
        $machineId = $request->input('machineId');
        $parts = Spare::select('id','part_no','description','buying_price','unit','gea_selling_price','selling_price','dimension')->where('machine_id', $machineId)->get();

        return response()->json($parts);
    }

    public function create()
    {
        $machines = Machine::all()->sortBy('machine_id');
        $spares = Spare::all()->sortBy('part_id');
        return view('stockinventory.incomingstockadd', compact('machines', 'spares'));
    }
        public function store(Request $request)
    {
        $request->validate([
            // 'date' => 'required|date',
            // 'rack_no' => 'required|string',
            // 'carrot_no' => 'required|string',
            // 'description' => 'required|string',
            // 'machine_id' => 'required|exists:machines,id',
            // 'part_id' => 'required|exists:spares,id',
            // 'dwg_no' => 'required|string',
            // 'quantity' => 'required|numeric',
            // 'unit' => 'required|string',
            // 'incoming' => 'required|numeric',
            // 'stock_in_hand' => 'required|numeric',
            // 'minimum_stock_alert' => 'required|numeric',
            // 'purchasing_price' => 'required|numeric',
            // 'total_purchasing' => 'required|numeric',
            // 'selling_price' => 'required|numeric',
            // 'total_selling_price' => 'required|numeric',
            // 'export_selling_price' => 'required|numeric',
            // 'gea_selling_price' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();
            $existingRecord = Incomingstock::where('machine_id', $request->machine_id)
                                          ->where('part_id', $request->part_id)
                                          ->first();

            if ($existingRecord) {
                $existingRecord->update([
                    'date' => $request->date,
                    'rack_no' => $request->rack_no,
                    'carrot_no' => $request->carrot_no,
                    'description' => $request->description,
                    'dwg_no' => $request->dwg_no,
                    'dimension'=>$request->dimension,
                    'quantity' => $existingRecord->quantity + $request->quantity,
                    'unit' => $request->unit,
                    'incoming' => $existingRecord->incoming + $request->incoming,
                    'stock_in_hand' => $existingRecord->stock_in_hand + $request->stock_in_hand,
                    'minimum_stock_alert' => $request->minimum_stock_alert,
                    'purchasing_price' => $request->purchasing_price,
                    'total_purchasing' => $request->total_purchasing,
                    'selling_price' => $request->selling_price,
                    'total_selling_price' => $request->total_selling_price,
                    'export_selling_price' => $request->export_selling_price,
                    'gea_selling_price' => $request->gea_selling_price,
                    'updated_by' => session('id'),
                ]);
            } else {
                Incomingstock::create([
                    'date' => $request->date,
                    'rack_no' => $request->rack_no,
                    'carrot_no' => $request->carrot_no,
                    'description' => $request->description,
                    'machine_id' => $request->machine_id,
                    'part_id' => $request->part_id,
                    'dwg_no' => $request->dwg_no,
                    'quantity' => $request->quantity,
                    'dimension'=>$request->dimension,
                    'unit' => $request->unit,
                    'incoming' => $request->incoming,
                    'stock_in_hand' => $request->stock_in_hand,
                    'minimum_stock_alert' => $request->minimum_stock_alert,
                    'purchasing_price' => $request->purchasing_price,
                    'total_purchasing' => $request->total_purchasing,
                    'selling_price' => $request->selling_price,
                    'total_selling_price' => $request->total_selling_price,
                    'export_selling_price' => $request->export_selling_price,
                    'gea_selling_price' => $request->gea_selling_price,
                    'created_by' => session('id'),
                    'updated_by' => session('id'),
                ]);
            }

            DB::commit();
            return redirect('/stockinventory/incomingstock')->with('success', 'Stock inventory added/updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error while adding/updating the record.');
        }
    }
    public function edit($id)
    {
        $incomingstock = Incomingstock::findOrFail($id);
        $machines = Machine::all()->sortBy('machine_id');
        $spares = Spare::all();
        return view('stockinventory.incomingstockedit', compact('incomingstock', 'machines', 'spares'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'rack_no' => 'required|string',
            'carrot_no' => 'required|string',
            'description' => 'required|string',
            'machine_id' => 'required|exists:machines,id',
            'part_id' => 'required|exists:spares,id',
            'dwg_no' => 'required|string',
            'quantity' => 'required|numeric',
            'unit' => 'required|string',
            'incoming' => 'required|numeric',
            'stock_in_hand' => 'required|numeric',
            'minimum_stock_alert' => 'required|numeric',
            'purchasing_price' => 'required|numeric',
            'total_purchasing' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'total_selling_price' => 'required|numeric',
            'export_selling_price' => 'required|numeric',
            'gea_selling_price' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();
            $incomingstock = Incomingstock::findOrFail($id);
            $incomingstock->update([
                'date' => $request->date,
                'rack_no' => $request->rack_no,
                'carrot_no' => $request->carrot_no,
                'description' => $request->description,
                'machine_id' => $request->machine_id,
                'part_id' => $request->part_id,
                'dwg_no' => $request->dwg_no,
                'quantity' => $request->quantity,
                'unit' => $request->unit,
                'dimension'=>$request->dimension,
                'incoming' => $request->incoming,
                'stock_in_hand' => $request->stock_in_hand,
                'minimum_stock_alert' => $request->minimum_stock_alert,
                'purchasing_price' => $request->purchasing_price,
                'total_purchasing' => $request->total_purchasing,
                'selling_price' => $request->selling_price,
                'total_selling_price' => $request->total_selling_price,
                'export_selling_price' => $request->export_selling_price,
                'gea_selling_price' => $request->gea_selling_price,
                'updated_by' => session('id'),
            ]);
            DB::commit();
            return redirect('/stockinventory/incomingstock')->with('success', 'Stock inventory updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error while updating the record.');
        }
    }
    public function destroy($id)
    {
        try {
            Incomingstock::destroy($id);
            return response()->json(['success' => 'Stock inventory deleted successfully.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Error while deleting the record.']);
        }
    }
}
