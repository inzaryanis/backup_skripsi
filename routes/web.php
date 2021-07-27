<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/cek_roles", 'AuthController@cek_roles');

Route::group(['middleware' => ['auth']],function(){

// ================= PART ==============================
Route::get('/home', 'MasterPartController@index')->middleware('auth');
Route::get('/create_mp', 'MasterPartController@create');
Route::post('/store_mp', 'MasterPartController@store');
Route::get('/part/getdata', 'MasterPartController@getdata');
Route::get('/edit/part/{id}', 'MasterPartController@dataModal');
Route::post('/update/part/', 'MasterPartController@update')->name('part.update');
// Route::delete('/delete/part/{id}', 'MasterPartController@destroy');
Route::delete('/delete/part/{id}', 'MasterPartController@destroy');
Route::get('part-detail-data/{id}/','MasterpartController@detailData');
Route::post('/part/import', 'MasterpartController@excelImport');

Route::get('/part/edit/{id}', 'MasterPartController@edit');
Route::post('/part/update/{id}', 'MasterPartController@update');



Route::get('/coba','MasterpartController@coba');


// ================ TYPE, BRAND, SERIES ==================
Route::post('/store_type', 'TypeController@store');
Route::post('/store_brand', 'BrandController@store');
Route::post('/store_series', 'SeriesController@store');

Route::post('/merk/import_excel', 'BrandController@import_excel');



// ================= CUSTOMER ==============================
            // ****** customer *******
 
Route::get('/create_customer', 'CustomerController@create');
Route::post('/store_customer', 'CustomerController@store')->name('customer.store');
Route::get('/edit/customer/{id}', 'CustomerController@dataModal');
Route::post('/update/customer/', 'CustomerController@update')->name('customer.update');
Route::delete('/delete/customer/{id}', 'CustomerController@destroy');
Route::post('/store_bc', 'CustomerController@store_bc');
Route::post('/store_bt', 'CustomerController@store_bt');
Route::post('/customer/import', 'CustomerController@excelImport');



            // ****** address *******
Route::get('/customer_address', 'AddressController@index');
Route::get('/customer_address/getdata','AddressController@getdata');
Route::get('/create_address', 'AddressController@create');
Route::post('/store_address', 'AddressController@store');
Route::get('/edit/address/{id}', 'AddressController@dataModal');
Route::post('/update/address/', 'AddressController@update')->name('address.update');
Route::delete('/delete/customer_address/{id}', 'AddressController@destroy');
Route::get('address-detail/{id}/','AddressController@detail');
Route::post('/address/import', 'AddressController@excelImport');







            // ****** contact *******
Route::get('/customer_contact', 'ContactController@index');
Route::get('/contact/getdata','ContactController@getdata');
Route::get('/create_contact', 'ContactController@create');
Route::post('/store_contact', 'ContactController@store');
Route::get('/address_contact/{id}', 'ContactController@address_contact');

Route::get('/edit/contact/{id}', 'ContactController@dataModal');
Route::post('/update/contact/', 'ContactController@update')->name('contact.update');
Route::delete('/delete/contact/{id}', 'ContactController@destroy');
Route::get('contact-detail/{id}/','ContactController@detail');




// ================= REQUEST FOR SERVICE ==============================
Route::get('/request', 'RFSController@index');
Route::get('/rfs/getdata', 'RFSController@getdata');
Route::get('/create_rfs', 'RFSController@create');
Route::post('/store_rfs', 'RFSController@store');
Route::post('/update_status/{id}', 'RFSController@update');
Route::post('/store_nopol', 'RFSController@storeNopol');
Route::get('/nomor_polisi/{id}', 'RFSController@getNopol');

Route::get('/request_from/{jenis}', 'RFSController@requestFrom');
Route::get('/request_type/{jenis}', 'RFSController@requestType');


Route::get('/company_requestor/{jenis}', 'RFSController@companyRequestor');


Route::delete('/delete/rfs/{id}', 'RFSController@destroy');
Route::get('rfs-detail/{id}/','RFSController@detail');

Route::get('nopol-detail/{id}/','RFSController@nopol');

Route::get('/edit/rfs/{id}', 'RFSController@dataModal');
Route::post('/update/rfs/', 'RFSController@update')->name('rfs.update');
Route::get('/pic/{id}', 'RfsController@requestor_pic');

Route::get('/phone/{id}', 'RFSController@getPhone');

Route::post('/rfs/import', 'RfsController@excelImport');



//

// Route::post('/session/set', 'RFSController@storeSession');
// Route::get('/session/get', 'RFSController@getSession');



// ================= INVENTORY ==============================
Route::get('/inventory', 'InventoryController@index');
Route::get('/inventory/getdata', 'InventoryController@getdata');
Route::delete('/delete/inventory/{id}', 'InventoryController@destroy');

Route::get('/type/{id}', 'InventoryController@getType');
Route::post('/material_receipt', 'InventoryController@store');
Route::post('/store_part', 'InventoryController@storePart');
Route::get('/material_receipt', 'InventoryController@material_receipt');
Route::get('/tools', 'InventoryController@tools');
Route::get('/tools/getdata', 'InventoryController@getTools');
Route::get('/consummable', 'InventoryController@consummable');
Route::get('/consummable/getdata', 'InventoryController@getConsummable');
Route::get('/accessories', 'InventoryController@accessories');
Route::get('/accessories/getdata', 'InventoryController@getAccessories');
Route::get('/gps_inventory', 'InventoryController@Gps');
Route::get('/gps_inventory/getdata', 'InventoryController@getGPS');



Route::get('/getallfields', 'InventoryController@getAllFields')->name('get.all.fields');



        // ******   GPS *********
Route::get('/gps', 'InventoryController@indexGps');
// Route::get('/gps/getdata', 'InventoryController@getdata');
Route::get('/create_gps', 'InventoryController@createGps');
Route::post('/store_gps', 'InventoryController@storeGps');

Route::post('/gps/import', 'GpsinstallationController@excelImport');
Route::post('/add_gps_install', 'GpsinstallationController@store');
Route::get('/gps-install/detail/{id}', 'GpsinstallationController@detail');
Route::delete('/gps_install/delete/{id}', 'GpsinstallationController@destroy');




        // ******   GSM *********
Route::get('/gsm', 'GSMController@index');
Route::get('/gsm/getdata', 'GSMController@getdata');
Route::post('/receipt_add', 'GSMController@receipt');
Route::get('/option/{jenis}', 'GSMController@option');
Route::get('/gsm_number/{id}', 'GSMController@getGsmnumber');
Route::post('/issued_add', 'GSMController@issued');
Route::post('/actived_add', 'GSMController@actived');
Route::post('/terminated_add', 'GSMController@terminated');
Route::post('/gsm/import', 'GSMController@excelImport');
Route::get('gsm-detail/{id}/','GSMController@detail');

Route::get('/edit/gsm/{id}', 'GSMController@dataModal');
Route::post('/update/gsm/', 'GSMController@update')->name('gsm.update');

        //actived

Route::post('/update_actived', 'GSMController@updateActived');
Route::get('/Display-Request-Actived', 'GSMController@Dra');
Route::get('/DRA/getdata', 'GSMController@getdataDRA');
Route::get('/Display-GSM-Actived', 'GSMController@DGA');
Route::get('/DGA/getdata', 'GSMController@getdataDGA');


        //terminated2
Route::post('/terminated2', 'GSMController@terminated2');
Route::post('/update_terminated', 'GSMController@updateTerminated');
Route::get('/Display-Request-Terminate', 'GSMController@Drt');
Route::get('/DRT/getdata', 'GSMController@getdataDRT');
Route::get('/Display-GSM-Terminate', 'GSMController@DGT');
Route::get('/DGT/getdata', 'GSMController@getdataDGT');

        







// ================= WORK ORDER ==============================

Route::get('/workorder', 'WorkorderController@index');

//********* Install & Mutation *********** */
Route::get('/install', 'WorkorderController@install');
Route::get('/bap/getdata', 'WorkorderController@getdataInstall');
Route::get('/edit/bap/{id}', 'WorkorderController@dataModalBap');
Route::post('/update/bap/', 'WorkorderController@updateBap')->name('bap.update');

Route::get('/create_bap', 'WorkorderController@create_bap');
Route::post('/add_bap', 'WorkorderController@storeBap');
Route::delete('/delete/bap/{id}', 'WorkorderController@destroy_bap');
Route::get('bap-detail/{id}/','WorkorderController@detailBap');


//********* Maintenance *********** */

Route::get('/create_spk', 'WorkorderController@create_spk');
Route::get('/maintenance', 'WorkorderController@maintenance');
Route::get('/maintenance/getdata', 'WorkorderController@getdataMaintenance');
Route::post('/add_spk', 'WorkorderController@storeSpk');
Route::get('/spk/detail/{id}', 'WorkorderController@detailSpk');


Route::get('/edit/spk/{id}', 'WorkorderController@dataModalSpk');
Route::post('/update/spk/', 'WorkorderController@updateSpk')->name('spk.update');
Route::delete('/spk/destroy/{id}', 'WorkorderController@destroySpk');

Route::get('spk-detail/{id}/','WorkorderController@detailSpk');






// ================= GPS Installation ==============================

Route::get('/gps_installation', 'GpsinstallationController@index');
Route::get('/gps/getdata', 'GpsinstallationController@getdata');
Route::get('/add_gps_installation', 'GpsinstallationController@add');
Route::get('/edit/gps_install/{id}', 'GpsinstallationController@dataModal');
Route::post('/update/gps/', 'GpsinstallationController@update')->name('gps_install.update');
Route::get('gps-detail/{id}/','GpsinstallationController@detail');
Route::delete('/delete/gps_install/{id}', 'GpsinstallationController@destroy');






// ================= REPORT ==============================

Route::get('/Visitation', 'ReportController@visitation');
Route::get('/gps_maintenance', 'ReportController@gpsMaintenance');
Route::get('/technician_work', 'ReportController@technicianWorkTimes');
Route::get('/terminate_extension', 'ReportController@terminateExtension');
Route::get('/terminate_activation', 'ReportController@terminateActivation');
Route::get('/terminate_error', 'ReportController@TerminateError');
Route::get('/equipment', 'ReportController@equipmentUsed');
Route::get('/Amount_free', 'ReportController@AmountFree');
Route::get('/Amount_paid', 'ReportController@Amountpaid');

//	*********************** ROLE ***************************
Route::get('/role','RoleController@index');
Route::get('/role/getdata','RoleController@getData');
Route::post('role/add','RoleController@storeRole');
Route::delete('role/delete/{id}','RoleController@deleteRole');
Route::get('/role/edit/{id}','RoleController@editRole');
Route::post('role/update','RoleController@updateRole');
Route::get('/role/menu/{id}','RoleController@menuRole');
Route::post('role/menu/update','RoleController@updateMenuRole');

Route::get('/menu','MenuController@index');
Route::get('/menu/getdata/menu_section','MenuController@dataMenuSection');
Route::get('/menu/getdata/menu','MenuController@dataMenu');
Route::get('/menu/getdata/sub_menu','MenuController@dataSubMenu');
Route::delete('/menu/destroy/{id}/{tipe}','MenuController@destroy');
Route::get('/menu/search/menu','MenuController@searchMenu');
Route::get('/menu/search/menusection','MenuController@searchMenuSection');
Route::post('/menu/add/menusection','MenuController@storeMenuSection');
Route::post('/menu/add/menu','MenuController@storeMenu');
Route::post('/menu/add/submenu','MenuController@storeSubMenu');
Route::get('/menu/edit/{id}/{tipe}','MenuController@editMenu');
Route::post('/menu/update','MenuController@updateMenu');
//	*********************** user ***************************
Route::get('/user','UserController@index');
Route::get('user/getdata','UserController@getData');
Route::delete('/user/delete/{id}','UserController@delete');
Route::get('user/edit/{id}','UserController@edit');
Route::post('user/add','UserController@store');
Route::post('user/update','UserController@update');
Route::get('/user/search/role','UserController@searchRole');

});


// =============== AUTH ==================================
Route::get('/', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/register', 'AuthController@register');
Route::get('/logout', 'AuthController@logout');
Route::post('/postregister', 'AuthController@postregister');


Route::get('/contoh','DatatablesController@index');
Route::get('/contoh/getdata','DatatablesController@getdata'); 

Route::get('/customer', 'CustomerController@index');
Route::get('/customer/getdata','CustomerController@getdata');


