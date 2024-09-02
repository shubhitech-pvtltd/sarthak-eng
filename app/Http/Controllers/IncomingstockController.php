<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Spare;
use App\Models\Incomingstock;
use App\Models\Availablestock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class IncomingstockController extends Controller
{
    public function index()
    {
        $machines = Machine::all();
        $spares = Spare::all();
        return view('stockinventory.incomingstocklist', compact('machines', 'spares'));
    }

    public function getincomingstocks(Request $request)
    {
        $incomingstocks = Incomingstock::select([
            'incomingstocks.id',
            'incomingstocks.date',
            'incomingstocks.rack_no',
            'incomingstocks.carrot_no',
            'incomingstocks.description',
            'incomingstocks.incoming',
            'incomingstocks.unit',
            'spares.part_no',
            'spares.minimum_stock_alert',
            'incomingstocks.stock_in_hand',
            'machines.model_no as machine_model',
        ])
        ->join('spares', 'incomingstocks.part_id', '=', 'spares.id')
        ->join('machines', 'spares.machine_id', '=', 'machines.id');

        // Apply filters
        if ($request->has('machine_id') && $request->machine_id != '') {
            $incomingstocks->where('machines.id', $request->machine_id);
        }

        if ($request->has('part_id') && $request->part_id != '') {
            $incomingstocks->where('spares.id', $request->part_id);
        }

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
  public function getIncomingstockDetails(Request $request)
    {
        $machineId = $request->input('machineId');
        $parts = Spare::select('id','part_no','description','buying_price','unit','gea_selling_price','selling_price','dimension' ,'minimum_stock_alert','quantity')->where('machine_id', $machineId)->get();

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
        Log::info('Request Data:', $request->all());

        $request->validate([
            'quantity' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $currentStock = Availablestock::where('machine_id', $request->machine_id)
                ->where('part_id', $request->part_id)
                ->value('quantity');

            $stock_in_hand = ($currentStock ?? 0) + $request->incoming;

            Log::info('Quantity before creation:', ['quantity' => $request->quantity]);

            $incomingstock = Incomingstock::create([
                'date' => $request->date,
                'rack_no' => $request->rack_no,
                'carrot_no' => $request->carrot_no,
                'description' => $request->description,
                'machine_id' => $request->machine_id,
                'part_id' => $request->part_id,
                'dwg_no' => $request->dwg_no,
                'quantity' => $request->quantity,
                'dimension' => $request->dimension,
                'unit' => $request->unit,
                'incoming' => $request->incoming,
                'stock_in_hand' => $stock_in_hand,
                'purchasing_price' => $request->purchasing_price,
                'total_purchasing' => $request->total_purchasing,
                'selling_price' => $request->selling_price,
                'total_selling_price' => $request->total_selling_price,
                'export_selling_price' => $request->export_selling_price,
                'gea_selling_price' => $request->gea_selling_price,
                'created_by' => session('id'),
                'updated_by' => session('id')
            ]);

            Log::info('Created Incomingstock:', $incomingstock->toArray());

            Availablestock::updateOrCreate(
                ['machine_id' => $request->machine_id, 'part_id' => $request->part_id],
                ['quantity' => $stock_in_hand]
                
            );

            Spare::where('id', $request->part_id)->update([
                'quantity' => $stock_in_hand,
            ]);

            DB::commit();

            return redirect('/stockinventory/incomingstock')->with('success', 'Stock inventory added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error while adding the record: ' . $e->getMessage())->withInput();
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
            'dwg_no' => 'nullable|string',
            'unit' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'incoming' => 'required|numeric|min:0',
            'stock_in_hand' => 'required|numeric|min:0',
            // 'minimum_stock_alert' => 'required|numeric|min:0',
            'purchasing_price' => 'nullable|numeric|min:0',
            'total_purchasing' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'total_selling_price' => 'nullable|numeric|min:0',
            'export_selling_price' => 'nullable|numeric|min:0',
            'gea_selling_price' => 'nullable|numeric|min:0',
            'dimension' => 'nullable|string',
        ]);
        try {
            DB::beginTransaction();

            $incomingstock = Incomingstock::findOrFail($id);
            $oldQuantity = $incomingstock->quantity;
            $quantityDifference = $request->quantity - $oldQuantity;

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
                'dimension' => $request->dimension,
                'incoming' => $request->incoming,
                'stock_in_hand' => $request->stock_in_hand,
                // 'minimum_stock_alert' => $request->minimum_stock_alert,
                'purchasing_price' => $request->purchasing_price,
                'total_purchasing' => $request->total_purchasing,
                'selling_price' => $request->selling_price,
                'total_selling_price' => $request->total_selling_price,
                'export_selling_price' => $request->export_selling_price,
                'gea_selling_price' => $request->gea_selling_price,
                'updated_by' => session('id'),
            ]);

            $spare = Spare::findOrFail($request->part_id);
            $spare->quantity += $quantityDifference;
            // $spare->minimum_stock_alert = $request->minimum_stock_alert;
            $spare->save();

            Availablestock::updateOrCreate(
                ['machine_id' => $request->machine_id, 'part_id' => $request->part_id],
                ['quantity' => DB::raw("quantity + $quantityDifference")]
            );

            DB::commit();
            return redirect('/stockinventory/incomingstock')->with('success', 'Stock inventory updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error while updating the record: ' . $e->getMessage());
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


    public function getBulk()
    {
        return view('stockinventory.bulkuploadincomingstock');
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
        'Incoming' => 'incoming',
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

            $data['incoming'] = $data['incoming'] ?? 0;

            $incomingstock = Incomingstock::create(array_merge($data, [
                'quantity' => 0,
                'stock_in_hand' => 0,
                'created_by' => session('id'),
                'updated_by' => session('id'),
            ]));

            if ($incomingstock) {
                Log::info('Inserted into Incomingstock: ', $incomingstock->toArray());

                $spare->quantity += $data['incoming'];
                $spare->save();
                Log::info('Updated Spare: ', $spare->toArray());

                $availablestock->quantity += $data['incoming'];
                $availablestock->save();
                Log::info('Updated Availablestock: ', $availablestock->toArray());
            } else {
                Log::error('Failed to insert into Incomingstock');
                throw new \Exception('Failed to insert into Incomingstock');
            }
        }

        DB::commit();
        return redirect('/stockinventory/incomingstock')->with('success', 'Stock records uploaded successfully');
    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Error during bulk upload: ' . $e->getMessage());
        Log::error('Error Trace: ' . $e->getTraceAsString()); 
        return redirect()->back()->with('error', 'Error occurred during bulk upload.');
    }
}

}