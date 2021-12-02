<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ShipperController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RefuelingController;


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

Route::get('/', [PageController::class, 'index']);

Route::get('/clients', [ClientController::class, 'index']);
Route::get('/suppliers', [SupplierController::class, 'index']);
Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/shippers', [ShipperController::class, 'index']);
Route::get('/vehicles', [VehicleController::class, 'index']);
Route::get('/dispatches', [DispatchController::class, 'index']);
Route::get('/dispatch_log', [DispatchController::class, 'log']);
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/shipments', [ShipmentController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);

Route::get('/add_supplier', [SupplierController::class, 'add_supplier']);
Route::get('/add_client', [ClientController::class, 'add_client']);
Route::get('/add_employee', [EmployeeController::class, 'add_employee']);
Route::get('/add_shipper', [ShipperController::class, 'add_shipper']);
Route::get('/add_vehicle', [VehicleController::class, 'add_vehicle']);
Route::get('/add_dispatch', [DispatchController::class, 'add_dispatch']);
Route::get('/add_order', [OrderController::class, 'add_order']);
Route::get('/add_shipment', [ShipmentController::class, 'add_shipment']);
Route::get('/add_product', [ProductController::class, 'add_product']);

Route::post('/add_supplier', [SupplierController::class, 'store']);
Route::post('/add_client', [ClientController::class, 'store']);
Route::post('/add_employee', [EmployeeController::class, 'store']);
Route::post('/add_shipper', [ShipperController::class, 'store']);
Route::post('/add_vehicle', [VehicleController::class, 'store']);
Route::post('/add_fuel/{vehicleId}', [RefuelingController::class, 'store']);
Route::post('/add_dispatch', [DispatchController::class, 'store']);
Route::post('/add_order', [OrderController::class, 'store']);
Route::post('/add_shipment', [ShipmentController::class, 'store']);
Route::post('/add_product', [ProductController::class, 'store']);
Route::get('/add_fuel/{vehicleId}', [RefuelingController::class, 'add_fuel']);

//Show actions (for editing records)
Route::get('/edit_supplier/{supplierId}',[SupplierController::class, 'show']);
Route::get('/edit_client/{clientId}',[ClientController::class, 'show']);
Route::get('/edit_employee/{employeeId}',[EmployeeController::class, 'show']);
Route::get('/edit_shipper/{shipperId}',[ShipperController::class, 'show']);
Route::get('/edit_vehicle/{vehicleId}',[VehicleController::class, 'show']);
Route::get('/edit_dispatch/{dispatchId}',[DispatchController::class, 'show']);
Route::get('/edit_order/{orderId}',[OrderController::class, 'show']);
Route::get('/edit_showroom_order/{orderId}',[OrderController::class, 'show']);
Route::get('/edit_shipment/{shipmentId}',[ShipmentController::class, 'show']);
Route::get('/edit_product/{productId}',[ProductController::class, 'show']);

Route::get('/view_order/{orderId}',[OrderController::class, 'showDetails']);
Route::get('/view_vehicle/{vehicleId}',[VehicleController::class, 'showDetails']);

//Patch/put actions
Route::patch('/edit_supplier/{supplier}',[SupplierController::class, 'update']);
Route::patch('/edit_client/{client}',[ClientController::class, 'update']);
Route::patch('/edit_employee/{employee}',[EmployeeController::class, 'update']);
Route::patch('/edit_shipper/{shipper}',[ShipperController::class, 'update']);
Route::patch('/edit_vehicle/{vehicle}',[VehicleController::class, 'update']);
Route::patch('/edit_dispatch/{dispatch}',[DispatchController::class, 'update']);
Route::patch('/edit_order/{order}',[OrderController::class, 'update']);
Route::patch('/edit_order/{order}',[OrderController::class, 'updateDetails']);
Route::patch('/edit_shipment/{shipment}',[ShipmentController::class, 'update']);
Route::patch('/edit_product/{product}',[ProductController::class, 'update']);

//Delete actions
Route::delete('/suppliers/{supplier}',[SupplierController::class, 'destroy']);
Route::delete('/clients/{client}',[ClientController::class, 'destroy']);
Route::delete('/employees/{employee}',[EmployeeController::class, 'destroy']);
Route::delete('/shippers/{shipper}',[ShipperController::class, 'destroy']);
Route::delete('/vehicles/{vehicle}',[VehicleController::class, 'destroy']);
Route::delete('/dispatches/{dispatch}',[DispatchController::class, 'destroy']);
Route::delete('/orders/{order}',[OrderController::class, 'destroy']);
Route::delete('/shipments/{shipment}',[ShipmentController::class, 'destroy']);
Route::delete('/products/{product}',[ProductController::class, 'destroy']);