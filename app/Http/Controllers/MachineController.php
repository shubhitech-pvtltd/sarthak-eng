<?php

namespace App\Http\Controllers;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::all();
        return view('machine.machinelist', compact('machines')); 
    }

   public function getMachines()
   {
        $machines = Machine::select(['id' , 'machine_name', 'description', 'model_no']);
        return DataTables::of($machines)
            ->addColumn('action', function ($machine) {
                return '
                    <div class="dropdown">
                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="'.url('/machine/'.$machine->id.'/edit').'"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="dropdown-item deleteBtn" data-url="'.url('/machine/'.$machine->id).'"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('machine.addmachine'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'machine_name' => 'required',
            'description' => 'required',
            'model_no' => 'required',
        ]);

        $machine = new Machine; 
        $this->setMachineAttributes($machine, $request);  
        $machine->created_by = Session::get('id');
        $machine->updated_by = Session::get('id');
        $machine->save();
        return redirect('/machine')->with('success', 'Machine added successfully'); 
    }

    public function edit(Machine $machine) 
    {
        return view('machine.addmachine', compact('machine')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'machine_name' => 'required',
            'description' => '',
            'model_no' => 'required',
        ]);

        $machine = Machine::findOrFail($id);
        $this->setMachineAttributes($machine, $request);
        $machine->updated_by = Session::get('id');
        $machine->save();
        return redirect('/machine')->with('success', 'Machine updated successfully'); 
    }

    public function destroy($id)
    {
        Machine::destroy($id);
    }

    private function setMachineAttributes(Machine $machine, Request $request) 
    {
        $machine->machine_name = $request->machine_name;
        $machine->description = $request->description;
        $machine->model_no = $request->model_no;
    }


    public function showBulkUploadForm()
    {
        return view('machine.bulkuploadmachine');
    }

    public function storeBulk(Request $request)
    {
        $request->validate([
            'machine_bulk_csv' => 'required|mimes:csv,txt',
        ]);
    
        if (!session()->has('id')) {
            return redirect()->back()->with('error', 'Session ID not found.');
        }
    
        $file = $request->file('machine_bulk_csv');
        $fileData = file_get_contents($file);
    
        $rows = array_map("str_getcsv", explode("\n", $fileData));
        $header = array_shift($rows); 
    
        $headerMapping = [
            'Machine Name' => 'machine_name',
            'Description' => 'description',
            'Model No' => 'model_no',
        ];
    
        DB::beginTransaction();
        try {
            foreach ($rows as $row) {
                Log::info('Processing Row:', $row);
    
                if (empty(array_filter($row))) {
                    Log::warning('Row skipped because it is empty or contains only null values.');
                    continue;
                }
    
                if (count($row) < count($header)) {
                    Log::warning('Row skipped due to insufficient columns: ' . json_encode($row));
                    continue;
                }
    
                $data = array_fill_keys(array_values($headerMapping), null);
    
                foreach ($header as $key => $column) {
                    $mappedField = $headerMapping[$column] ?? null;
                    if ($mappedField && isset($row[$key])) {
                        $data[$mappedField] = trim($row[$key]) !== '' ? trim($row[$key]) : null;
                    }
                }
    
                $existingMachine = Machine::where('machine_name', $data['machine_name'])
                                          ->where('model_no', $data['model_no'])
                                          ->first();
    
                if ($existingMachine) {
                    Log::warning('Duplicate found: Machine Name "' . $data['machine_name'] . '" with Model No "' . $data['model_no'] . '". Skipping row.');
                    return redirect()->back()->with('error', 'Duplicate entry found for Machine Name "' . $data['machine_name'] . '" with Model No "' . $data['model_no'] . '". Upload aborted alredy your data base.');
                }
    
                $data['created_by'] = session('id') ?? 1;  
                $data['updated_by'] = session('id') ?? 1;
    
                Log::info('Session ID:', ['id' => session('id')]);  
    
                if (is_null($data['machine_name']) || is_null($data['model_no'])) {
                    Log::warning('Row skipped due to missing required fields: ' . json_encode($row));
                    continue;
                }
    
                Log::info('Mapped Data: ', $data);
    
                $machine = Machine::create($data);
    
                if ($machine) {
                    Log::info('Inserted into Machine: ', $machine->toArray());
                } else {
                    Log::error('Failed to insert into Machine');
                    throw new \Exception('Failed to insert into Machine');
                }
            }
    
            DB::commit();
            return redirect('/machine')->with('success', 'Machine records uploaded successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error during bulk upload: ' . $e->getMessage());
            Log::error('Error Trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Error occurred during bulk upload.');
        }
    }
    
    
}    