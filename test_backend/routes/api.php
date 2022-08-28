<?php

use App\Http\Controllers\StudentSubjectScoreController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'cors'], function () {
    Route::post('/score_student', [StudentSubjectScoreController::class, 'score_student'])->name('test.score_student');
    Route::get('/retrieve_score', [StudentSubjectScoreController::class, 'retrieve_score'])->name('test.retrieve_score');
    Route::get('/get_subjects', [StudentSubjectScoreController::class, 'get_subjects'])->name('test.get_subjects');
    Route::post('/purge_scores', [StudentSubjectScoreController::class, 'purge_scores'])->name('test.purge_scores');
});