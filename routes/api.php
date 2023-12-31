<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CategoryApiController;
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

Route::middleware('auth:sanctum')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);
Route::prefix('v1')->group(
    function () {
        Route::get('/categories', [CategoryApiController::class, 'indexWrapped'])
            ->middleware('auth:sanctum')
            ->name('api.category.index.wrapped');
///
//        Route::get('/categories', [CategoryApiController::class, 'index'])
//            //->middleware('auth:sanctum')
//            ->name('api.category.index');

        Route::get('/categories/{id}', [CategoryApiController::class, 'show'])
            ->middleware('auth:sanctum')
            ->name('api.category.show');

        Route::post('/categories', [CategoryApiController::class, 'store'])
            ->middleware('auth:sanctum')
            ->name('api.category.store');

        Route::delete('/categories/{id}', [CategoryApiController::class, 'destroy'])
            ->middleware('auth:sanctum')
            ->name('api.category.destroy');

        Route::patch('/categories/{id}', [CategoryApiController::class, 'update'])
            ->middleware('auth:sanctum')
            ->name('api.category.update');

        Route::post('/login', [AuthApiController::class, 'login'])
            ->name('api.user.login');

        Route::get('/logout', [AuthApiController::class, 'logout'])
            ->name('api.user.logout');
    }
);
