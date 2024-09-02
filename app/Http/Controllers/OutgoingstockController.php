<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Spare;
use App\Models\Outgoingstock;
use App\Models\Availablestock;
use App\Models\Incomingstock; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class OutgoingstockController extends Controller
{
    public function index()
    {
        $machines = Machine::all();
        $spares = Spare::all();
        return view('stockinventory.outgoingstocklist', compact('machines', 'spares'));
    }

    public function getOutgoingstocks(Request $request)
    {
        $query = Outgoingstock::select([
            'outgoingstocks.id',
            'outgoingstocks.date',
            'outgoingstocks.rack_no',
            'outgoingstocks.carrot_no',
            'outgoingstocks.description',
            'outgoingstocks.outgoing',
            'outgoingstocks.unit',
            'spares.part_no',
            'spares.minimum_stock_alert',
            'outgoingstocks.stock_in_hand',
            'machines.model_no as machine_model',
        ])
        ->join('spares', 'outgoingstocks.part_id', '=', 'spares.id')
        ->join('machines', 'spares.machine_id', '=', 'machines.id');

        // Apply filters based on the request inputs
        if ($request->machine_id) {
            $query->where('machines.id', $request->machine_id);
        }
        if ($request->part_id) {
            $query->where('spares.id', $request->part_id);
        }

        return DataTables::of($query)
            ->addColumn('action', function ($outgoingstock) {
                return '
                    <div class="dropdown">
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="'.url('/stockinventory/outgoingstock/'.$outgoingstock->id.'/edit').'"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="dropdown-item deleteBtn" data-url="'.url('/stockinventory/outgoingstock/'.$outgoingstock->id).'"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }    public function getOutgoingstockDetails(Request $request)
    {
        $machineId = $request->input('machineId');
        $parts = Spare::select('id','part_no','description','buying_price','unit','gea_selling_price','selling_price','dimension','quantity')->where('machine_id', $machineId)->get();
        return response()->json($parts);
    }

    public function create()
    {
        $machines = Machine::all()->sortBy('machine_id');
        $spares = Spare::all()->sortBy('part_id');
        return view('stockinventory.outgoingstockadd', compact('machines', 'spares'));
    }

    public function store(Request $request)
    {
        Log::info('Request Data:', $request->all());

        $availablestock = Availablestock::where('machine_id', $request->machine_id)
            ->where('part_id', $request->part_id)
            ->first();

        if ($availablestock) {
            Log::info('Available stock found: ' . $availablestock->quantity);
            $quantity = $availablestock->quantity;
        } else {
            Log::warning('No available stock found for the given machine_id and part_id.');
            $quantity = 0;
        }
        $request->validate([
            'outgoing' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($quantity) {
                    if ($value > $quantity) {
                        $fail('The outgoing quantity cannot exceed the available stock.');
                    }
                },
            ],
        ]);

        try {
            DB::beginTransaction();

            $stock_in_hand = $quantity - $request->outgoing;

            $outgoingstock = Outgoingstock::create([
                'date' => $request->date,
                'rack_no' => $request->rack_no,
                'carrot_no' => $request->carrot_no,
                'description' => $request->description,
                'machine_id' => $request->machine_id,
                'part_id' => $request->part_id,
                'dwg_no' => $request->dwg_no,
                'quantity' => $request->quantity,
                'unit' => $request->unit,
                'dimension' => $request->dimension,
                'outgoing' => $request->outgoing,
                'stock_in_hand' => $stock_in_hand,
                'purchasing_price' => $request->purchasing_price,
                'total_purchasing' => $request->total_purchasing,
                'selling_price' => $request->selling_price,
                'total_selling_price' => $request->total_selling_price,
                'export_selling_price' => $request->export_selling_price,
                'gea_selling_price' => $request->gea_selling_price,
                "created_by" => session('id'),
                "updated_by" => session('id')
            ]);

            if ($availablestock) {
                $availablestock->update([
                    'quantity' => $stock_in_hand,
                ]);
            } else {
                Availablestock::create([
                    'machine_id' => $request->machine_id,
                    'part_id' => $request->part_id,
                    'quantity' => $request->quantity - $request->outgoing,
                    "created_by" => session('id'),
                    "updated_by" => session('id')
                ]);
            }

            $spare = Spare::find($request->part_id);
            $spare->update([
                'quantity' => $spare->quantity - $request->outgoing,
            ]);

            DB::commit();
            return redirect('/stockinventory/outgoingstock')->with('success', 'Stock inventory added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error while adding the record: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $outgoingstock = Outgoingstock::findOrFail($id);
        $machines = Machine::all()->sortBy('machine_id');
        $spares = Spare::all()->sortBy('part_id');

        return view('stockinventory.outgoingstockedit', compact('outgoingstock', 'machines', 'spares'));
    }
    public function update(Request $request, $id)
    {
        Log::info('Request Data:', $request->all());

        $request->validate([
            // 'date' => 'required|date',
            // 'rack_no' => 'required|string',
            // 'carrot_no' => 'required|string',
            // 'description' => 'required|string',
            // 'machine_id' => 'required|exists:machines,id',
            // 'part_id' => 'required|exists:spares,id',
            // 'dwg_no' => 'required|string',
            // 'quantity' => 'required|numeric|min:0',
            // 'unit' => 'required|string',
            // 'outgoing' => 'required|numeric|min:0',
            // 'stock_in_hand' => 'required|numeric|min:0',
            // 'minimum_stock_alert' => 'required|numeric|min:0',
            // 'purchasing_price' => 'required|numeric|min:0',
            // 'total_purchasing' => 'required|numeric|min:0',
            // 'selling_price' => 'required|numeric|min:0',
            // 'total_selling_price' => 'required|numeric|min:0',
            // 'export_selling_price' => 'required|numeric|min:0',
            // 'gea_selling_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();
                $outgoingstock = Outgoingstock::findOrFail($id);

            $stock_in_hand = $request->stock_in_hand - $request->outgoing;
                $outgoingstock->update([
                'date' => $request->date,
                'rack_no' => $request->rack_no,
                'carrot_no' => $request->carrot_no,
                'description' => $request->description,
                'machine_id' => $request->machine_id,
                'part_id' => $request->part_id,
                'dwg_no' => $request->dwg_no,
                'quantity' => $request->quantity,
                'unit' => $request->unit,
                'dimension' => $request->dimension,
                'outgoing' => $request->outgoing,
                'stock_in_hand' => $stock_in_hand,
                'purchasing_price' => $request->purchasing_price,
                'total_purchasing' => $request->total_purchasing,
                'selling_price' => $request->selling_price,
                'total_selling_price' => $request->total_selling_price,
                'export_selling_price' => $request->export_selling_price,
                'gea_selling_price' => $request->gea_selling_price,
                "updated_by" => session('id')
            ]);

            $availablestock = Availablestock::where('machine_id', $request->machine_id)
                ->where('part_id', $request->part_id)
                ->first();

            if ($availablestock) {
                $availablestock->update([
                    'quantity' => $availablestock->quantity - $request->outgoing + ($outgoingstock->quantity - $request->quantity),
                ]);
            } else {
                Availablestock::create([
                    'machine_id' => $request->machine_id,
                    'part_id' => $request->part_id,
                    'quantity' => $request->quantity - $request->outgoing,
                    "created_by" => session('id'),
                    "updated_by" => session('id')
                ]);
            }

            $spare = Spare::find($request->part_id);
            $spare->update([
                'quantity' => $spare->quantity - $request->outgoing + ($outgoingstock->quantity - $request->quantity),
            ]);

            DB::commit();
            return redirect('/stockinventory/outgoingstock')->with('success', 'Stock inventory updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error while updating the record: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            Outgoingstock::destroy($id);
            return response()->json(['success' => 'Stock outgoing deleted successfully.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Error while deleting the record.']);
        }
    }

    public function getBulk()
    {
        return view('stockinventory.bulkuploadoutgoingstock');
    }
   
public function storeBulk(Request $request)
{
    $request->validate([
        'stock_bulk_csv' => 'required|mimes:csv,txt',
    ]);

    $file = $request->file('stock_bulk_csv');
    $fileData = file_get_contents($file);

    $rows = array_map("str_getcsv", explode("\n", $fileData));
    $header = array_shift($rows); 

    $headerMapping = [
        'Date' => 'date',
        'Part ID' => 'part_id',
        'Machine Model' => 'machine_id',
        'Rack' => 'rack_no',
        'Carrot No' => 'carrot_no',
        'Quantity' => 'quantity',
        'Outgoing' => 'outgoing',
        'Stock In Hand' => 'stock_in_hand',
        'Minimum Stock Alert' => 'minimum_stock_alert',
        'Unit' => 'unit',
        'Purchasing Price' => 'purchasing_price',
        'Total Purchasing' => 'total_purchasing',
        'Selling Price' => 'selling_price',
        'Total Selling Price' => 'total_selling_price',
        'Export Selling Price' => 'export_selling_price',
        'GEA Selling Price' => 'gea_selling_price',
        'Description' => 'description',
        'DWG No' => 'dwg_no',
        'Dimension' => 'dimension',
    ];

    DB::beginTransaction();
    try {
        foreach ($rows as $row) {
            if (count($row) < count($header)) {
                Log::warning('Row skipped due to insufficient columns: ' . json_encode($row));
                continue; 
            }

            $data = array_fill_keys(array_values($headerMapping), null);

            foreach ($header as $key => $column) {
                $mappedField = $headerMapping[$column] ?? null;
                if ($mappedField && isset($row[$key])) {
                    if ($mappedField == 'date') {
                        $date = \DateTime::createFromFormat('d-m-Y', $row[$key]);
                        if ($date) {
                            $data[$mappedField] = $date->format('Y-m-d');
                        } else {
                            Log::warning('Invalid date format: ' . $row[$key]);
                            $data[$mappedField] = null;
                        }
                    } else {
                        $data[$mappedField] = $row[$key] !== '' ? $row[$key] : null;
                    }
                }
            }

            if (is_null($data['part_id'])) {
                Log::warning('Row skipped because part_id is null: ' . json_encode($row));
                continue; 
            }

            $spare = Spare::where('id', $data['part_id'])
                          ->where('machine_id', $data['machine_id'])
                          ->first();

            if (!$spare) {
                Log::error('No matching record found in Spares for machine_id: ' . $data['machine_id'] . ' and part_id: ' . $data['part_id']);
                return redirect()->back()->with('error', 'Mismatch detected: No matching record found in Spares table for Machine ID: ' . $data['machine_id'] . ' and Part ID: ' . $data['part_id']);
            }

            $availablestock = Availablestock::where('machine_id', $data['machine_id'])
                ->where('part_id', $data['part_id'])
                ->first();

            if (!$availablestock) {
                $availablestock = Availablestock::create([
                    'machine_id' => $data['machine_id'],
                    'part_id' => $data['part_id'],
                    'quantity' => 0, 
                    'minimum_stock_alert' => $data['minimum_stock_alert'],
                    'created_by' => session('id'),
                    'updated_by' => session('id'),
                ]);
                Log::info('Created new Availablestock: ', $availablestock->toArray());
            }

            Log::info('Mapped Data: ', $data);

            $data['outgoing'] = $data['outgoing'] ?? 0;

            if ($spare->quantity < $data['outgoing'] || $availablestock->quantity < $data['outgoing']) {
                Log::error('Insufficient stock for Machine ID: ' . $data['machine_id'] . ' and Part ID: ' . $data['part_id']);
                return redirect()->back()->with('error', 'Insufficient stock: Unable to process outgoing stock for Machine ID: ' . $data['machine_id'] . ' and Part ID: ' . $data['part_id']);
            }

            $availablestock->quantity -= $data['outgoing'];
            $availablestock->save();
            Log::info('Updated Availablestock: ', $availablestock->toArray());

            $spare->quantity -= $data['outgoing'];
            $spare->save();
            Log::info('Updated Spare: ', $spare->toArray());

            $outgoingstock = Outgoingstock::create(array_merge($data, [
                'quantity' => 0, 
                'stock_in_hand' => 0, 
                'created_by' => session('id'),
                'updated_by' => session('id'),
            ]));

            if ($outgoingstock) {
                Log::info('Inserted into Outgoingstock: ', $outgoingstock->toArray());
            } else {
                Log::error('Failed to insert into Outgoingstock');
                throw new \Exception('Failed to insert into Outgoingstock');
            }
        }

        DB::commit();
        return redirect('/stockinventory/outgoingstock')->with('success', 'Stock records processed successfully');
    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Error during bulk upload: ' . $e->getMessage());
        Log::error('Error Trace: ' . $e->getTraceAsString()); 
        return redirect()->back()->with('error', 'Error occurred during bulk upload.');
    }
}

}