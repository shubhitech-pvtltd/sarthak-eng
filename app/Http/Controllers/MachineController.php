<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::all();
        return view('machine.machinelist', compact('machines')); 
    }

    
  //  For Server Side Datatable
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
            'description' => 'required',
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
}
