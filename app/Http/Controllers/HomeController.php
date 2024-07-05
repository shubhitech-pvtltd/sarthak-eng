<?php

namespace App\Http\Controllers;

use App\Models\Customerprice;
use App\Models\Machine;
use App\Models\Buyer;
use App\Models\Quotation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $customerprice = Customerprice::count();
        $machineCount = Machine::count();
        $buyerCount = Buyer::count();
        $quotationCount = Quotation::count();

        return view('pages.index', compact('customerprice', 'machineCount', 'buyerCount', 'quotationCount'));
    }
}
