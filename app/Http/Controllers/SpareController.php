<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Spare;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use App\Models\Machine;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SpareController extends Controller
{
    public function index()
    {
        return view('spare.sparepartlist');
    }

    public function getSpares()
    {
        $spares = Spare::select(['spares.id', 'spares.part_no' ,'spares.description', 'spares.purchase_from', 'spares.buying_price', 'spares.selling_price', 'spares.drawing_upload', 'spares.gea_selling_price', 'spares.unit', 'spares.hsn_code', 'spares.currency', 'spares.dimension', 'machines.machine_name'])
            ->join('machines', 'spares.machine_id', '=', 'machines.id')
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
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $machines = Machine::all(); 
        return view('spare.addsparepart', compact('machines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'machine_id' => '',
            'part_no' => 'required',
            'description' => 'required',
            // 'drawing_upload' => 'mimes:pdf,jpg,jpeg,png'
        ]);
        
        try {
            if ($request->hasFile('drawing_upload')) {
                $imgName = "Sarthak" . Str::random(30) . "." . $request->file('drawing_upload')->getClientOriginalExtension();
                $file = $request->file('drawing_upload');    
                $path = $file->move('images/upload/sparedrawing', $imgName);
            
                if ($path) {                  
                    Log::info('File upload: ' . $path);
                } else {
                    $error = $file->getErrorMessage();
                    Log::error('File upload failed: ' . $error);
                }
            } else {
                Log::error('No file uploaded');
            }
            
            Spare::create([
                "machine_id" => $request->machine_id,   
                "part_no" => $request->part_no,          
                "description" => $request->description,
                "purchase_from" => $request->purchase_from,
                "buying_price" => $request->buying_price,
                "selling_price" => $request->selling_price,
                "drawing_upload" => $imgName ?? null,
                "gea_selling_price" => $request->gea_selling_price,
                "unit" => $request->unit,
                "hsn_code" => $request->hsn_code,
                "currency" => $request->currency,
                "dimension" => $request->dimension,
                'created_by' => session('id'),
                'updated_by' => session('id')
            ]);

            return redirect('/spare')->with('success', 'Spare added successfully');
        } catch(\Exception $e) {
            Log::error('Error while adding the record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while adding the record');
        }
    }

    public function edit(Spare $spare)
    {
        $machines = Machine::all(); 
        return view('spare.addsparepart', compact('machines', 'spare'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'machine_id' => 'required',
            'part_no' => 'required',
            'description' => 'required',
            // 'drawing_upload' => 'mimes:pdf,jpg,jpeg,png'
        ]);

        try {
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
                "currency" => $request->currency,
                "dimension" => $request->dimension,
                'updated_by' => session('id')
            ]);

            if ($request->hasFile('drawing_upload')) {
                Storage::delete($spare->drawing_upload);
                $imgName = "Sarthak" . Str::random(30) . "." . $request->file('drawing_upload')->getClientOriginalExtension();
                $path = $request->file('drawing_upload')->move('images/upload/sparedrawing', $imgName);
               
                $spare->update([
                    "drawing_upload" => $imgName,
                ]);
            }
            return redirect('/spare')->with('success', 'Spare updated successfully');
        } catch(\Exception $e) {
            Log::error('Error while updating the record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating the record');
        }
    }
    public function destroy($id)
    {
        $result = Spare::destroy($id);
    }
}

    