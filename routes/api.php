<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::middleware('location')->group(function () {

    Route::get('/migrate-and-seed', function (Request $request) {

        return true;
        // Run migrations
        Artisan::call('migrate');

        // Seed the database
        Artisan::call('db:seed');

        return response()->json(['message' => 'Migration and seeding complete']);
    });

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/{post}', [PostController::class, 'show']);
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{post}', [PostController::class, 'update']);
        Route::delete('/{post}', [PostController::class, 'destroy']);
    });
});
