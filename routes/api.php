<?php

use App\Http\Controllers\api\ActController;
use App\Http\Controllers\api\BuildingObjectController;
use App\Http\Controllers\api\CertificateController;
use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\ContractController;
use App\Http\Controllers\api\ExecutiveSchemeController;
use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\api\RepresentativeController;
use App\Http\Controllers\api\WorkVolumeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('common')->group(function () {
    Route::get('/acts-list', [ActController::class, 'getAllActs'])->name('getAllActs'); //работает
    Route::get('/certificates-list', [CertificateController::class, 'getAllCertificates'])->name('certificatesList'); //Работает
    Route::get('/companies-list', [CompanyController::class, 'getAllCompanies'])->name('getAllCompanies'); //работает
    Route::get('/contracts-list', [ContractController::class, 'getAllContracts'])->name('getAllContracts'); //работает
    Route::get('/executive-schemes-list', [ExecutiveSchemeController::class, 'getAllExecutiveSchemes'])->name('getAllExecutiveSchemes'); //работает
    Route::get('/projects-list', [ProjectController::class, 'getAllProjects'])->name('getAllProjects'); //работает
    Route::get('/representatives-list', [RepresentativeController::class, 'getAllRepresentatives'])->name('getAllRepresentatives'); //работает
    Route::get('/work-volumes-list', [WorkVolumeController::class, 'getAllWorkVolumes'])->name('getAllWorkVolumes'); //работает
    Route::get('/objects-list', [BuildingObjectController::class, 'getAllBuildingObjects'])->name('getAllBuildingObjects');//работает
});

Route::prefix('acts')->group(function () {  //закончить функции по созданию акта
    Route::get('/{id}', [ActController::class, 'getActById'])->name('getActById');
    Route::get('/form-data', [ActController::class, 'getActFormData'])->name('getActFormData'); //ПОКАЗ СПИСКА ВСЕХ ДОКУМЕНТОВ, КОТОРЫЕ НУЖЫ ДЛЯ СОЗДАНИЯ АКТА
    Route::post('/create', [ActController::class, 'createAct'])->name('createAct'); //Работает
    Route::patch('/update/{id}', [ActController::class, 'updateAct'])->name('updateAct'); //работает
    Route::delete('/delete/{id}', [ActController::class, 'deleteAct'])->name('deleteAct'); //работает
    Route::get('/{id}/generate', [ActController::class, 'generateAct'])->name('generateAct');
});

Route::prefix('certificates')->group(function () {
    Route::get('/{id}', [CertificateController::class, 'getCertificateById'])->name('getCertificateById'); //работает
    Route::post('/create', [CertificateController::class, 'createCertificate'])->name('createCertificate'); //работает
    Route::patch('/update/{id}', [CertificateController::class, 'updateCertificate'])->name('updateCertificate'); //Работает
    Route::delete('/delete/{id}', [CertificateController::class, 'deleteCertificate'])->name('deleteCertificate'); //Работает
});

Route::prefix('companies')->group(function () {
    Route::get('/{id}', [CompanyController::class, 'getCompanyById'])->name('getCompanyById'); //работает
    Route::post('/create', [CompanyController::class, 'createCompany'])->name('createCompany'); //работает
    Route::patch('/update/{id}', [CompanyController::class, 'updateCompany'])->name('updateCompany'); //работает
    Route::delete('/delete/{id}', [CompanyController::class, 'deleteCompany'])->name('deleteCompany'); //работает
});

Route::prefix('contracts')->group(function () {
    Route::get('/{id}', [ContractController::class, 'getContractById'])->name('getContractById'); //работает
    Route::post('/create', [ContractController::class, 'createContract'])->name('createContract'); //работает
    Route::patch('/update/{id}', [ContractController::class, 'updateContract'])->name('updateContract'); //работает
    Route::delete('/delete/{id}', [ContractController::class, 'deleteContract'])->name('deleteContract'); //работает
});
Route::prefix('schemes')->group(function () {
    Route::get('/{id}', [ExecutiveSchemeController::class, 'getExecutiveSchemeById'])->name('getExecutiveSchemeById'); //работает
    Route::post('/create', [ExecutiveSchemeController::class, 'createExecutiveScheme'])->name('createExecutiveScheme'); //работает
    Route::patch('/update/{id}', [ExecutiveSchemeController::class, 'updateExecutiveScheme'])->name('updateExecutiveScheme'); //работает
    Route::delete('delete/{id}', [ExecutiveSchemeController::class, 'deleteExecutiveScheme'])->name('deleteExecutiveScheme'); //работает
});

Route::prefix('projects')->group(function () {
    Route::get('/{id}', [ProjectController::class, 'getProjectById'])->name('getProjectById'); //Работает
    Route::post('/create', [ProjectController::class, 'createProject'])->name('createProject'); //Работает
    Route::patch('/update/{id}', [ProjectController::class, 'updateProject'])->name('updateProject'); //работает
    Route::delete('/delete/{id}', [ProjectController::class, 'deleteProject'])->name('deleteProject'); //Работает
});
Route::prefix('representatives')->group(function () {
    Route::get('/{id}', [RepresentativeController::class, 'getRepresentativeById'])->name('getRepresentativeById'); //работает
    Route::post('/create', [RepresentativeController::class, 'createRepresentative'])->name('createRepresentative'); //работает
    Route::patch('/update/{id}', [RepresentativeController::class, 'updateRepresentative'])->name('updateRepresentative');//работает
    Route::delete('/delete/{id}', [RepresentativeController::class, 'deleteRepresentative'])->name('deleteRepresentative'); //работает
});
Route::prefix('work-volumes')->group(function () {
    Route::get('/{id}', [WorkVolumeController::class, 'getWorkVolumeById'])->name('getWorkVolumeById');//работает
    Route::post('/create', [WorkVolumeController::class, 'createWorkVolume'])->name('createWorkVolume');//работает
    Route::patch('/update/{id}', [WorkVolumeController::class, 'updateWorkVolume'])->name('updateWorkVolume');//работает
    Route::delete('/delete/{id}', [WorkVolumeController::class, 'deleteWorkVolume'])->name('deleteWorkVolume'); //работает
});

Route::prefix('objects')->group(function () {
    Route::get('/{id}', [BuildingObjectController::class, 'getBuildingObjectById'])->name('getBuildingObjectById'); //работает
    Route::post('/create', [BuildingObjectController::class, 'createBuildingObject'])->name('createBuildingObject'); //работает
    Route::patch('/update/{id}', [BuildingObjectController::class, 'updateBuildingObject'])->name('updateBuildingObject'); //работает
    Route::delete('/delete/{id}', [BuildingObjectController::class, 'deleteBuildingObject'])->name('deleteBuildingObject'); //Работает

});
