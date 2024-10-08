<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CustomerWisePriceController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\SpareController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AvailablestockController;
use App\Http\Controllers\IncomingstockController;
use App\Http\Controllers\OutgoingstockController;
use App\Http\Controllers\ReportsController;


Route::get('/login',[LoginController::class,'login']);

Route::post('/login',[LoginController::class,'SubmitLogin']);

Route::middleware(['CheckAuth'])->group(function(){

    Route::get('/', [HomeController::class, 'index']);

    Route::view('/forgot-password','login.forgot-password');

    Route::get('/logout', function () {
        session()->flush();
        return redirect('/login');
    });

    Route::view('/help','pages.help');

    Route::resource('/user' , UserController::class);

    //client
    Route::get('/client/data' , [ClientController::class,'getClients']);
    Route::get('/client/bulkupload' , [ClientController::class,'getBulk']);
    Route::post('/client/bulkupload/submit' , [ClientController::class,'storeBulk']);
    Route::resource('/client' , ClientController::class);

    //machine
    Route::get('/machine/data' , [MachineController::class,'getMachines']);
    Route::resource('/machine', MachineController::class)->except(['show']);
    Route::get('/machine/bulkupload', [MachineController::class, 'showBulkUploadForm'])->name('machine.bulkupload.form');
    Route::post('/machine/bulkupload/submit', [MachineController::class, 'storeBulk'])->name('machine.bulkupload.submit');

    //sapre
    Route::get('/spare/data' , [SpareController::class,'getSpares']);
    Route::resource('/spare', SpareController::class)->except(['show']);
    Route::get('/spare/bulkupload', [SpareController::class, 'showBulkUploadForm'])->name('spare.bulkupload.form');
    Route::post('/spare/bulkupload/submit', [SpareController::class, 'storeBulk'])->name('sapre.bulkupload.submit');

//customerprice
    Route::get('/customerprice/data', [CustomerWisePriceController::class, 'getCustomerprice'])->name('customerprice.data');
    Route::resource('/customerprice', CustomerWisePriceController::class);

//quotation
    Route::get('/quotation/data', [QuotationController::class, 'data'])->name('quotation.data');
    Route::resource('/quotation', QuotationController::class);

    //bayer
    Route::get('/buyer/data' , [BuyerController::class,'getBuyers']);
    Route::post('/buyer/add', [BuyerController::class, 'addBuyer'])->name('buyer.add');
    Route::resource('/buyer' , BuyerController::class);


});


Route::post('/get-machine-details', [CustomerWisePriceController::class, 'getMachineDetails'])->name('getMachineDetails');
Route::get('/get-customerprice-details' , [CustomerWisePriceController::class ,'get_customerlist_details'])->name('get-customerprice-details');

//quotation
Route::get('/get-customerlist-details' , [QuotationController::class ,'get_customerlist_details'])->name('get-customerlist-details');
Route::get('/get-quotationlist-details' , [QuotationController::class ,'getQuotationListDetails'])->name('get-Quotationlist-details');
Route::get('/getCustomerprice', [QuotationController::class, 'getCustomerprice'])->name('getCustomerprice');
Route::get('/quotation/{id?}/view', [QuotationController::class, 'viewQuotation'])->name('quotation.view');
Route::get('/quotation/{id}/pdf', [QuotationController::class, 'downloadPDF'])->name('quotation.pdf');

//Availablestock
Route::resource('/stockinventory/availablestock', AvailablestockController::class);
Route::get('/availablestock/data', [AvailablestockController::class, 'getAvailablestocks'])->name('availablestock.data');
Route::get('/availablestock/{id}/edit', [AvailablestockController::class, 'edit'])->name('availablestock.edit');
Route::put('/availablestock/{id}', [AvailablestockController::class, 'update'])->name('availablestock.update');
Route::post('/availablestock/update-alert/{id}', [AvailablestockController::class, 'update'])->name('availablestock.update');



//outgoingstock
Route::get('/outgoingstock/data' , [OutgoingstockController::class, 'getOutgoingstocks']);
Route::resource('/stockinventory/outgoingstock', OutgoingstockController::class)->except(['show']);
Route::get('/stockinventory/outgoingstock/bulkupload', [OutgoingstockController::class, 'getBulk'])->name('outgoingstock.bulk');
Route::post('/stockinventory/outgoingstock/bulkupload/submit', [OutgoingstockController::class, 'storeBulk'])->name('outgoingstock.storeBulk');

//Reports
Route::get('/stockinventory/reports', [ReportsController::class, 'index']);
Route::resource('/stockinventory/reports',ReportsController::class);
Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
Route::get('/report/data', [ReportsController::class, 'getReportData'])->name('report.data');

//incomingstock
Route::get('/stockinventory/incomingstock/bulkupload', [IncomingstockController::class, 'getBulk'])->name('incomingstock.bulk');
Route::post('/stockinventory/incomingstock/bulkupload/submit', [IncomingstockController::class, 'storeBulk'])->name('incomingstock.storeBulk');
Route::get('/incomingstock/data', [IncomingstockController::class, 'getIncomingstocks'])->name('incomingstock.data');
Route::resource('/stockinventory/incomingstock', IncomingstockController::class)->except(['show']);
Route::post('/get-incoming-details', [IncomingstockController::class, 'getIncomingstockDetails'])->name('getIncomingstockDetails');



// Route::post('/machines', [MachineController::class, 'store'])->name('machines.store');

// Route::get('/machines/{machine}/edit', [MachineController::class, 'edit'])->name('machines.edit');


// Route::put('/machines/{machine}', [MachineController::class, 'update'])->name('machines.update');

// Route::delete('/machines/{machine}', [MachineController::class, 'destroy'])->name('machines.destroy');


// resource controller meaning
// GET         /user               index        show user list
// GET         /user/create        create       add user page
// POST        /user               store        add user post request
// GET         /user/{id}          show         show specific user details
// GET         /user/{id}/edit     edit         edit user page show
// PUT/PATCH   /user/{id}          update       edit user hit request
// DELETE      /user/{id}          destroy      user delete hit



// routes not in use

// Route::get('/selectuser','SelectUserController@select');

// Route::get('/view/{id}','ViewController@view');

// Route::get('/view/api/{user_id}','ViewController@GetTransactionData');

// Route::post('/view/submitform','ViewController@SubmitForm');

// Route::get('/view/api/delete/{trans_id}','ViewController@DeleteTransactionData');

// Route::get('/datewisetransaction','DateController@Date');

// Route::post('/date/gettransactiondata','DateController@GetTransactionData');

// Route::get('/getpdf/{user_id}','ViewController@generatePDF');

// Route::get('/excel/{user_id}','ViewController@excel');

// Route::get('/addinvoice','AddInvoiceController@ViewInvoice');

// Route::post('/invoice/submitform','AddInvoiceController@SubmitForm');

// Route::get('/invoice/delete/{invoice_id}','AddInvoiceController@DeleteInvoice');

// Route::get('/invoicereport','InvoiceReportController@viewReport');

// Route::post('/invoice/getreport','InvoiceReportController@GetReportData');

// Route::get('/invoice/getpdf/{startDate}&{endDate}','InvoiceReportController@generatePDF');

// Route::get('/invoice/getexcel/{startDate}&{endDate}','InvoiceReportController@generateExcel');
