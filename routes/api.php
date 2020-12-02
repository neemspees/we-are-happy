<?php

use App\Constants\Permissions;
use App\Http\Controllers\API\StatisticsController;
use App\Http\Controllers\API\VoteController;
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

Route::get('/statistics', [StatisticsController::class, 'get'])->middleware('permission:' . Permissions::READ_STATISTICS);
Route::post('/votes', [VoteController::class, 'create'])->middleware('permission:' . Permissions::CREATE_VOTE);
