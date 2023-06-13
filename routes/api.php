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
            ->name('api.category.index.wrapped');

        Route::get('/categories/{id}', [CategoryApiController::class, 'show'])
            ->name('api.category.show');

        Route::post('/categories', [CategoryApiController::class, 'store'])
            ->name('api.category.store');

        Route::delete('/categories/{id}', [CategoryApiController::class, 'destroy'])
            ->name('api.category.destroy');

        Route::patch('/categories/{id}', [CategoryApiController::class, 'update'])
            ->name('api.category.update');

        Route::post('/login', [AuthApiController::class, 'login'])
            ->name('api.user.login');
    }
);
