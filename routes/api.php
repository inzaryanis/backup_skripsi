<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Rfs;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('rfs/{rfs}', function ($id) {
    return Rfs::find($id);

});





// ================= REQUEST FOR SERVICE ==============================
Route::get('rfs', 'RFSController@index_api');
Route::delete('rfs/{rfs}', 'RFSController@destroy');
// Route::get('/create_rfs', 'RFSController@create');
Route::post('rfs/store', 'RFSController@store');
// Route::post('/update_status/{id}', 'RFSController@update');
