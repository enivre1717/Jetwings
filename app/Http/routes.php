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
    Route::get('/fitbookings/details', "ViewsController@bookingDetails");
    Route::get('/fitbookings/welcome', "ViewsController@welcome");
    Route::get('/in-store/index', "ViewsController@inStore");
    Route::get('/feedback/index', "ViewsController@feedback");
    
    Route::get('/safety-contracts/index', "ViewsController@safetyContracts");
    Route::get('/own-expenses/index', "ViewsController@ownExpenses");
    Route::get('/arrival/index', "ViewsController@arrival");
    Route::get('/commissions/index', "ViewsController@commissions");
    Route::get('/claims/index', "ViewsController@claims");
    
    Route::get('/errors/{errorCode}', "ViewsController@error");
    
    Route::get('/notification/success', function () {
        return view('modal.success');
    });
});

//Route::view('/fitbookings/list', 'welcome');

Route::group(['namespace' => 'Api','prefix' => 'api'], function () {
    
    Route::post('login', "TourGuidesController@login");
    Route::post('logout', "TourGuidesController@logout");
    Route::get('me', "TourGuidesController@getTourGuideDetails");
    
    Route::post('fitbookings/mine', "FitBookingsController@getFitBookings");
    
    Route::get('fitbookings/mine/{id}', "FitBookingsController@getFitBookingsById");
    Route::get('fitbookings/welcome/{id}', "FitBookingsController@getWelcomeSign");
    
    Route::get('fit-transports/{id}', "FitTransportsController@getFitTransportsById");
    Route::get('sales-agencies/{id}', "SaleAgenciesController@getSaleAgenciesById");
    Route::get('restaurants', "RestaurantsController@getRestaurants");
    Route::get('tickets', "TicketsController@getTickets");
    Route::get('attractions', "AttractionsController@getAttractions");
    Route::get('common/other-expenses-claim-options', "CommonController@getOtherExpensesClaimOptions");
    
    Route::post('fit-flights/get-arrival-details', "FitFlightsController@getArrivalDetails");
    
    Route::post('safety-contracts/submit', "SafetyContractController@submitForm");
    Route::post('own-expenses/submit', "OwnExpensesController@submitForm");
    Route::post('in-store/submit', "InStoreController@submitForm");
    Route::post('arrival-form/submit', "ArrivalFormController@submitForm");
    Route::post('commission-form/submit', "CommissionFormController@submitForm");
    
    Route::get('arrival-form/{id}', "ArrivalFormController@index");
    Route::get('commission-form/{id}', "CommissionFormController@index");
    Route::get('claims/{id}', "ClaimsController@index");
    
});


