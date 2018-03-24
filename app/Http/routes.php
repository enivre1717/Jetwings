<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['namespace' => 'Web'], function () {
    Route::get('/', "IndexController@index");
    Route::get('/login', "IndexController@login");

    Route::get('/fitbookings/list', "ViewsController@listBookings");
    Route::get('/fitbookings/forms', "ViewsController@forms");
    
    Route::get('/safety-contract/index', "ViewsController@safetyContract");
    Route::get('/own-expenses/index', "ViewsController@ownExpenses");
    
    Route::get('/notification/success', function () {
        return view('modal.success');
    });
});

//Route::view('/fitbookings/list', 'welcome');

Route::group(['namespace' => 'Api','prefix' => 'api'], function () {
    
    Route::post('login', "TourGuidesController@login");
    Route::post('logout', "TourGuidesController@logout");
    Route::post('fitbookings/mine', "FitBookingsController@getFitBookings");
    
    Route::get('fitbookings/mine/{id}', "FitBookingsController@getFitBookingsById");
    Route::get('fitbookings/welcome/{id}', "FitBookingsController@getWelcomeSign");
    
    Route::get('fit-transports/fitbookingid/{id}', "FitTransportsController@getFitTransportsById");
    
    Route::post('safety-contracts', "SafetyContractController@submitForm");
    Route::post('own-expenses', "OwnExpensesController@submitForm");
    
    Route::get('sales-agencies/{id}', "SaleAgenciesController@getSaleAgenciesById");
    
});


