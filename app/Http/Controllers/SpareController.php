<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Spare;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Machine;
use Illuminate\Support\Facades\DB;
class SpareController extends Controller
{
    public function index()
    {
        return view('spare.sparepartlist');
    }

    public function getSpares()
    {
        $spares = Spare::select([
            'spares.id',
            'spares.part_no',
            'spares.description',
            'spares.purchase_from',
            'spares.buying_price',
            'spares.selling_price',
            'spares.drawing_upload',
            'spares.gea_selling_price',
            'spares.unit',
            'spares.hsn_code',
            'spares.comment',
            'spares.dimension',
            'spares.machine_id',
            'machines.machine_name',
            'machines.model_no',
        ])
        ->leftJoin('machines', 'spares.machine_id', '=', 'machines.id')
        ->orderBy('machines.machine_name')
        ->orderBy('machines.model_no')
        ->orderBy('spares.machine_id')
        ->get();

        return DataTables::of($spares)
            ->addColumn('action', function ($spare) {
                return '
                    <div class="dropdown">
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="'.url('/spare/'.$spare->id.'/edit').'"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="dropdown-item deleteBtn" data-url="'.url('/spare/'.$spare->id).'"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';
            })
            ->editColumn('machines.machine_name', function ($spare) {
                return $spare->machine_name ?? 'N/A';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function create()
{
    $machines = Machine::select('id', 'machine_name', 'model_no')->orderBy('machine_name')->orderBy('model_no')->get();
    
    return view('spare.addsparepart', compact('machines'));
}


    public function store(Request $request)
    {
        $request->validate([
            'machine_id' => 'nullable|exists:machines,id',
            'part_no' => 'required',
            'description' => 'required',
            'purchase_from' => 'required',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'gea_selling_price' => 'required|numeric',
            'unit' => 'required|string',
            'hsn_code' => 'required|string',
            'dimension' => 'required|string',
            'drawing_upload' => 'nullable|file|mimes:jpeg,webp,png,jpg|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $imgName = null;
            if ($request->hasFile('drawing_upload')) {
                Log::info('File found in the request');
                $file = $request->file('drawing_upload');
                $imgName = "Spare_" . Str::random(30) . "." . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/images/upload/sparedrawing', $imgName);
                if ($path) {
                    Log::info('File uploaded successfully: ' . $path);
                } else {
                    Log::error('File upload failed');
                    throw new \Exception('File upload failed');
                }
            } else {
                Log::info('No file found in the request');
            }
        
            Spare::create([
                "machine_id" => $request->machine_id,
                "part_no" => $request->part_no,
                "description" => $request->description,
                "purchase_from" => $request->purchase_from,
                "buying_price" => $request->buying_price,
                "selling_price" => $request->selling_price,
                "drawing_upload" => $imgName,
                "gea_selling_price" => $request->gea_selling_price,
                "unit" => $request->unit,
                "hsn_code" => $request->hsn_code,
                "comment" => $request->comment,
                "dimension" => $request->dimension,
                'created_by' => session('id'),
                'updated_by' => session('id')
            ]);
            DB::commit();
            return redirect('/spare')->with('success', 'Spare added successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while adding the record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while adding the record');
        }
    }

    public function edit(Spare $spare)
    {
        $machines = Machine::select('id', 'machine_name', 'model_no')->orderBy('machine_name')->orderBy('model_no')->get();

        return view('spare.addsparepart', compact('machines', 'spare'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'machine_id' => 'nullable|exists:machines,id',
            'part_no' => 'required',
            'description' => 'required',
            'purchase_from' => 'required',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'gea_selling_price' => 'required|numeric',
            'unit' => 'required|string',
            'hsn_code' => 'required|string',
            'dimension' => 'required|string',
            'drawing_upload' => 'nullable|file|mimes:jpeg,webp,png,jpg|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $spare = Spare::findOrFail($id);
            $spare->update([
                "machine_id" => $request->machine_id,
                "part_no" => $request->part_no,
                "description" => $request->description,
                "purchase_from" => $request->purchase_from,
                "buying_price" => $request->buying_price,
                "selling_price" => $request->selling_price,
                "gea_selling_price" => $request->gea_selling_price,
                "unit" => $request->unit,
                "hsn_code" => $request->hsn_code,
                "comment" => $request->comment,
                "dimension" => $request->dimension,
                'updated_by' => session('id')
            ]);
            DB::commit();

            if ($request->hasFile('drawing_upload')) {
                Log::info('File found in the request');             
                Storage::delete($spare->drawing_upload);             
                $file = $request->file('drawing_upload');
                $imgName = "Spare_" . Str::random(30) . "." . $file->getClientOriginalExtension();           
                $path = $file->storeAs('public/images/upload/sparedrawing', $imgName);
                if ($path) {
                    Log::info('File uploaded successfully: ' . $path);
                    $spare->update([
                        "drawing_upload" => $imgName,
                    ]);
                } else {
                    Log::error('File upload failed');
                    throw new \Exception('File upload failed');
                }
            } else {
                Log::info('No file found in the request');
            }
            return redirect('/spare')->with('success', 'Spare updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while updating the record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating the record');
        }
    }

    public function destroy($id)
    {
       $result = Spare::destroy($id);
    }

    public function showBulkUploadForm()
    {
        return view('spare.sparebulkupload');
    }
  
    public function storeBulk(Request $request)
{
    $request->validate([
        'spare_bulk_csv' => 'required|mimes:csv,txt',
    ]);

    $file = $request->file('spare_bulk_csv');
    $fileData = file_get_contents($file);

    $rows = array_map("str_getcsv", explode("\n", $fileData));
    $header = array_shift($rows); 

    $headerMapping = [
        'Machine ID' => 'machine_id',
        'Part No' => 'part_no',
        'Description' => 'description',
        'Purchase From' => 'purchase_from',
        'Buying Price' => 'buying_price',
        'Selling Price' => 'selling_price',
        'Drawing Upload' => 'drawing_upload',
        'GEA Selling Price' => 'gea_selling_price',
        'Unit' => 'unit',
        'HSN Code' => 'hsn_code',
        'Comment' => 'comment',
        'Dimension' => 'dimension',
    ];

    DB::beginTransaction();
    try {
        foreach ($rows as $row) {
            if (empty(array_filter($row))) {
                Log::warning('Row skipped because it is empty or contains only null values.');
                continue;
            }

            $data = array_fill_keys(array_values($headerMapping), null);

            foreach ($header as $key => $column) {
                $mappedField = $headerMapping[$column] ?? null;
                if ($mappedField && isset($row[$key])) {
                    $data[$mappedField] = trim($row[$key]) !== '' ? trim($row[$key]) : null;
                }
            }

            $data['created_by'] = session('id') ?? 1;
            $data['updated_by'] = session('id') ?? 1;

            Log::info('Mapped Data: ', $data);

            if (is_null($data['machine_id']) || is_null($data['part_no'])) {
                Log::warning('Row skipped due to missing required fields: ' . json_encode($row));
                continue;
            }

            $machineExists = Machine::where('id', $data['machine_id'])->exists();

            if (!$machineExists) {
                Log::error('Machine ID: ' . $data['machine_id'] . ' does not exist in the Machine table. Skipping this row.');
                return redirect()->back()->with('error', 'Machine ID: ' . $data['machine_id'] . ' does not exist in the Machine table. Upload aborted.');
            }

            $existingSpare = Spare::where('machine_id', $data['machine_id'])
                                   ->where('part_no', $data['part_no'])
                                   ->first();

            if ($existingSpare) {
                Log::info('Record with Machine ID: ' . $data['machine_id'] . ' and Part No: ' . $data['part_no'] . ' already exists. Skipping insertion.');
                continue;
            }

            $spare = Spare::create($data);

            if ($spare) {
                Log::info('Inserted into Spare: ', $spare->toArray());
            } else {
                Log::error('Failed to insert into Spare');
                throw new \Exception('Failed to insert into Spare');
            }
        }

        DB::commit();
        return redirect('/spare')->with('success', 'Spare records uploaded successfully');
    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Error during bulk upload: ' . $e->getMessage());
        Log::error('Error Trace: ' . $e->getTraceAsString());
        return redirect()->back()->with('error', 'Error occurred during bulk upload.');
    }
}
  
}