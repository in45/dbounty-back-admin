<?php

use App\Http\Controllers\BadgeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VulnerabilityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::pattern('user_id', '0x[0-9a-zA-Z]{40}');

//API For Users

Route::get('users', [UserController::class, 'index']);
Route::get('users/{user_id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::post('users/{user_id}', [UserController::class, 'update']);
Route::delete('users/{user_id}', [UserController::class, 'destroy']);

// API For Companies

Route::get('companies', [CompanyController::class, 'index']);
Route::get('companies/{id}', [CompanyController::class, 'show']);
Route::get('companies/{id}/managers', [CompanyController::class, 'getManagers']);
Route::post('companies/{id}/managers', [CompanyController::class, 'addManager']);
Route::delete('companies/{id}/managers/{manager_id}', [CompanyController::class, 'deleteManager']);
Route::post('companies', [CompanyController::class, 'store']);
Route::post('companies/{id}', [CompanyController::class, 'update']);
Route::post('companies/{id}/avatar', [CompanyController::class, 'updateAvatar']);
Route::delete('companies/{id}', [CompanyController::class, 'destroy']);
Route::post('companies/{id}/avatar',[CompanyController::class, 'updateAvatar']);
Route::delete('companies/{id}', [CompanyController::class, 'destroy']);

// API For Badges

Route::get('badges', [BadgeController::class, 'index']);
Route::get('badges/{id}',  [BadgeController::class, 'show']);
Route::get('me/badges', [BadgeController::class, 'getMyBadges']);
Route::get('users/{user_id}/badges', [BadgeController::class, 'getBadgesOfUser']);
Route::post('badges', [BadgeController::class, 'store']);
Route::post('badges/{id}', [BadgeController::class, 'update']);
Route::post('badges/{id}/avatar',[BadgeController::class, 'updateAvatar']);
Route::delete('badges/{id}', [BadgeController::class, 'destroy']);


//API For Programs

Route::get('programs', [ProgramController::class, 'index']);
Route::get('programs/{id}', [ProgramController::class, 'show']);
Route::post('programs', [ProgramController::class, 'store']);
Route::post('programs/{id}', [ProgramController::class, 'update']);
Route::delete('programs/{id}', [ProgramController::class, 'destroy']);

//API For Reports

Route::get('reports', [ReportController::class, 'index']);
Route::get('reports/{id}', [ReportController::class, 'show']);
Route::post('reports', [ReportController::class, 'store']);
Route::post('reports/{id}', [ReportController::class, 'update']);
Route::delete('reports/{id}', [ReportController::class, 'destroy']);

//API For Vulnerabilities

Route::get('vulns', [VulnerabilityController::class, 'index']);
Route::get('vulns/{id}', [VulnerabilityController::class, 'show']);
Route::post('vulns', [VulnerabilityController::class, 'store']);
Route::post('vulns/{id}', [VulnerabilityController::class, 'update']);
Route::delete('vulns/{id}', [VulnerabilityController::class, 'destroy']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
