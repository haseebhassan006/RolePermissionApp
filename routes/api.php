<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\user\UserController;

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
Route::post('/logout',[UserController::class,'logout']);

Route::prefix('management')->group(function () {
    Route::resource('user', UserController::class);
    Route::post('remove-all/users',[UserController::class,'removeAllUsers']);
    Route::get('/roles-perimissions',[UserController::class,'getRolesPermissions']);
    Route::resource('role', RoleController::class);
    Route::post('remove-all/roles',[UserController::class,'removeAllRoles']);
    Route::resource('permission', PermissionController::class);
    Route::post('remove-all/permissions',[UserController::class,'removeAllPermissions']);
});
