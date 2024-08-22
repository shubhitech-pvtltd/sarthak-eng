<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incomingstock;
use App\Models\Outgoingstock;
use App\Models\Spare;
use App\Models\Machine;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        $machines = Machine::all();
        $spares = Spare::all();

        return view('stockinventory.reports', compact('machines', 'spares'));
    }

    public function getReportData(Request $request)
    {
        $incomingQuery = DB::table('incomingstocks')
            ->join('spares', 'incomingstocks.part_id', '=', 'spares.id')
            ->join('machines', 'incomingstocks.machine_id', '=', 'machines.id')
            ->select(
                'spares.part_no as part_no',
                'machines.model_no as machine_model',
                'incomingstocks.incoming as incoming',
                DB::raw('NULL as outgoing'),
                'incomingstocks.quantity as quantity',
                'spares.minimum_stock_alert as minimum_stock_alert',
                'incomingstocks.unit as unit',
                'incomingstocks.date as date',
                'incomingstocks.rack_no as rack_no',
                'incomingstocks.stock_in_hand as stock_in_hand',
                'incomingstocks.purchasing_price as purchasing_price',
                'incomingstocks.total_purchasing as total_purchasing',
                'incomingstocks.selling_price as selling_price',
                'incomingstocks.total_selling_price as total_selling_price',
                'incomingstocks.export_selling_price as export_selling_price',
                'incomingstocks.gea_selling_price as gea_selling_price',
                'incomingstocks.carrot_no as carrot_no',
                'incomingstocks.description as description',
                'incomingstocks.dwg_no as dwg_no',
                'incomingstocks.dimension as dimension'
            );

        if ($request->filled('machine_id')) {
            $incomingQuery->where('machines.id', $request->input('machine_id'));
        }

        if ($request->filled('part_id')) {
            $incomingQuery->where('spares.id', $request->input('part_id'));
        }

        if ($request->filled('start_date')) {
            $incomingQuery->whereDate('incomingstocks.date', '>=', $request->input('start_date'));
        }

        if ($request->filled('end_date')) {
            $incomingQuery->whereDate('incomingstocks.date', '<=', $request->input('end_date'));
        }

        $outgoingQuery = DB::table('outgoingstocks')
            ->join('spares', 'outgoingstocks.part_id', '=', 'spares.id')
            ->join('machines', 'outgoingstocks.machine_id', '=', 'machines.id')
            ->select(
                'spares.part_no as part_no',
                'machines.model_no as machine_model',
                DB::raw('NULL as incoming'),
                'outgoingstocks.outgoing as outgoing',
                'outgoingstocks.quantity as quantity',
                'spares.minimum_stock_alert as minimum_stock_alert',
                'outgoingstocks.unit as unit',
                'outgoingstocks.date as date',
                'outgoingstocks.rack_no as rack_no',
                'outgoingstocks.stock_in_hand as stock_in_hand',
                'outgoingstocks.purchasing_price as purchasing_price',
                'outgoingstocks.total_purchasing as total_purchasing',
                'outgoingstocks.selling_price as selling_price',
                'outgoingstocks.total_selling_price as total_selling_price',
                'outgoingstocks.export_selling_price as export_selling_price',
                'outgoingstocks.gea_selling_price as gea_selling_price',
                'outgoingstocks.carrot_no as carrot_no',
                'outgoingstocks.description as description',
                'outgoingstocks.dwg_no as dwg_no',
                'outgoingstocks.dimension as dimension'
            );

        if ($request->filled('machine_id')) {
            $outgoingQuery->where('machines.id', $request->input('machine_id'));
        }

        if ($request->filled('part_id')) {
            $outgoingQuery->where('spares.id', $request->input('part_id'));
        }

        if ($request->filled('start_date')) {
            $outgoingQuery->whereDate('outgoingstocks.date', '>=', $request->input('start_date'));
        }

        if ($request->filled('end_date')) {
            $outgoingQuery->whereDate('outgoingstocks.date', '<=', $request->input('end_date'));
        }

        $combinedQuery = $incomingQuery->unionAll($outgoingQuery);

        $finalQuery = DB::table(DB::raw("({$combinedQuery->toSql()}) as sub"))
            ->mergeBindings($combinedQuery)
            ->select(
                'sub.part_no',
                'sub.machine_model',
                'sub.incoming',
                'sub.outgoing',
                'sub.quantity',
                'sub.unit',
                'sub.rack_no',
                'sub.minimum_stock_alert',
                'sub.stock_in_hand',
                'sub.date',
                'sub.purchasing_price',
                'sub.total_purchasing',
                'sub.selling_price',
                'sub.total_selling_price',
                'sub.export_selling_price',
                'sub.gea_selling_price',
                'sub.carrot_no',
                'sub.description',
                'sub.dwg_no',
                'sub.dimension'
            )
            ->orderBy('sub.date', 'asc');

        return DataTables::of($finalQuery)->make(true);
    }

}
