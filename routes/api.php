<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\JobController;
use App\Http\Controllers\Api\V1\TruckController;
use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\CompanyOfficeContactController;
use App\Http\Controllers\Api\V1\EloTeamController;
use App\Http\Controllers\Api\V1\TrailerController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\DocumentController;
use App\Http\Controllers\Api\V1\EmployeeController;
use App\Http\Controllers\Api\V1\GeofenceController;
use App\Http\Controllers\Api\V1\TruckTagController;
use App\Http\Controllers\Api\V1\TruckTireController;
use App\Http\Controllers\Api\V1\CostCenterController;
use App\Http\Controllers\Api\V1\DepartmentController;
use App\Http\Controllers\Api\V1\SalaryTypeController;
use App\Http\Controllers\Api\V1\TruckPlateController;
use App\Http\Controllers\Api\V1\DriverTruckController;
use App\Http\Controllers\Api\V1\TrailerTireController;
use App\Http\Controllers\Api\V1\TrailerTypeController;
use App\Http\Controllers\Api\V1\WorkdayTypeController;
use App\Http\Controllers\Api\V1\ContractTypeController;
use App\Http\Controllers\Api\V1\DocumentTypeController;
use App\Http\Controllers\Api\V1\LocationTypeController;
use App\Http\Controllers\Api\V1\TrailerModelController;
use App\Http\Controllers\Api\V1\TrailerPlateController;
use App\Http\Controllers\Api\V1\CompanyOfficeController;
use App\Http\Controllers\Api\V1\TruckDocumentController;
use App\Http\Controllers\Api\V1\VehicleStatusController;
use App\Http\Controllers\Api\V1\CompanyParkingController;
use App\Http\Controllers\Api\V1\CustomerStatusController;
use App\Http\Controllers\Api\V1\EmployeeStatusController;
use App\Http\Controllers\Api\V1\TrailerDocumentController;
use App\Http\Controllers\Api\V1\CustomerLocationController;
use App\Http\Controllers\Api\V1\CustomerLocationContactController;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\ColoniaController;
use App\Http\Controllers\Api\V1\EstadoController;
use App\Http\Controllers\Api\V1\MunicipioController;
use App\Http\Controllers\Api\V1\EmployeeDocumentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('config')->group(function () {
    Route::apiResource('documents', DocumentController::class);
    Route::apiResource('document-types', DocumentTypeController::class);
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('employee-statuses', EmployeeStatusController::class);
    Route::apiResource('vehicle-statuses', VehicleStatusController::class);
    Route::apiResource('geofences', GeofenceController::class);
    Route::apiResource('employee-documents', EmployeeDocumentController::class);
    Route::post('employee-documents/download-multiple', [EmployeeDocumentController::class, 'downloadMultipleEmployeeDocument']);
    Route::get('employee-documents/{id}/download', [EmployeeDocumentController::class, 'downloadEmployeeDocument']);
    Route::get('colonias', [ColoniaController::class, 'index']);
    Route::get('countries', [CountryController::class, 'index']);
    Route::get('states', [EstadoController::class, 'index']);
    Route::get('municipalities', [MunicipioController::class, 'index']);
});

Route::prefix('companies')->group(function () {
    Route::apiResource('companies', CompanyController::class);
    Route::apiResource('contract-types', ContractTypeController::class);
    Route::apiResource('elo-teams', EloTeamController::class);
    Route::apiResource('cost-centers', CostCenterController::class);
    Route::apiResource('workday-types', WorkdayTypeController::class);
    Route::apiResource('cost-centers', CostCenterController::class);
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('salary-types', SalaryTypeController::class);
    Route::apiResource('jobs', JobController::class);
    Route::apiResource('company-parkings', CompanyParkingController::class);
    Route::apiResource('company-offices', CompanyOfficeController::class);
    Route::apiResource('company-office-contacts', CompanyOfficeContactController::class);
});

Route::prefix('customers')->group(function () {
    Route::apiResource('customers', CustomerController::class);
    Route::get('/customers/data/{customerId?}/{locationId?}', [CustomerController::class, 'getCustomerData']);
    Route::apiResource('customer-statuses', CustomerStatusController::class);
    Route::apiResource('customer-locations', CustomerLocationController::class);
    Route::apiResource('location-types', LocationTypeController::class);
    Route::apiResource('customer-location-contacts', CustomerLocationContactController::class);
});

Route::prefix('trailers')->group(function () {
    Route::apiResource('trailer-types', TrailerTypeController::class);
    Route::apiResource('trailer-models', TrailerModelController::class);
    Route::apiResource('trailers', TrailerController::class);
    Route::apiResource('trailer-tires', TrailerTireController::class);
    Route::apiResource('trailer-plates', TrailerPlateController::class);
    Route::apiResource('trailer-documents', TrailerDocumentController::class);
    Route::get('trailer-documents/{id}/download', [TrailerDocumentController::class, 'downloadTrailerDocument']);
});

Route::prefix('trucks')->group(function () {
    Route::apiResource('trucks', TruckController::class);
    Route::apiResource('truck-tires', TruckTireController::class);
    Route::apiResource('truck-tags', TruckTagController::class);
    Route::apiResource('truck-plates', TruckPlateController::class);
    Route::apiResource('truck-documents', TruckDocumentController::class);
    Route::apiResource('driver-trucks', DriverTruckController::class);
    Route::get('truck-documents/{id}/download', [TruckDocumentController::class, 'downloadTruckDocument']);
});
