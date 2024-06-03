<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;


Route::get('/login',[LoginController::class,'login']);

Route::post('/login',[LoginController::class,'SubmitLogin']);

Route::middleware(['CheckAuth'])->group(function(){

    Route::view('/','pages.index');

    Route::view('/forgot-password','login.forgot-password');
    
    Route::get('/logout', function () {
        session()->flush();
        return redirect('/login');
    });
    
    Route::view('/help','pages.help');
    
    Route::resource('/user' , UserController::class);
    
    Route::get('/client/data' , [ClientController::class,'getClients']);
    
    Route::resource('/client' , ClientController::class);
    
});

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
