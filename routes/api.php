<?php

use Illuminate\Http\Request;

/******  Load and search in contractors and suppliers page  ******/
Route::get('/contractors',  								'API\ContractorController@index');
Route::get('/contractors/{search}',  						'API\ContractorController@search');
Route::get('/suppliers',  									'API\SupplierController@index');
Route::get('/suppliers/{search}',  							'API\SupplierController@search');

/******  Handle infinite scroll in contractors page  ******/
Route::get('/contractor-unli-scroll',  						'API\ContractorController@scroll');
Route::get('/sort/contractor-unli-scroll',  				'API\SortContractorController@index');

Route::get('/supplier-unli-scroll',  						'API\SupplierController@scroll');

/******  Handle project images using VueJs DropDown  ******/
Route::post('/projects/{uuid}/images/add', 						'API\ProjectImageController@store');

/******  Load see more in profile  ******/
Route::get('/profile/{username}', 								'API\ProfileController@show');

Route::get('/classifications', 									'API\ClassificationController');

// Route::get('/job-invitations', 									'API\JobInvitationController@index');

// Route::get('/location/regions', 								'API\LocationController@region');
// Route::get('/locations/regions/{id}/cities', 					'API\LocationController@cities');