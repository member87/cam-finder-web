<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CameraController;

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

Route::get('/', [CameraController::class, "index"]);
Route::get('/view/{id}', [CameraController::class, "show"])->name('view.camera');



Route::post('/api/xml2json/', [CameraController::class, "xml2json"])->name('api.xml2json');
Route::post('/api/request/', [CameraController::class, "makeRequest"])->name('api.request');
Route::post('/api/snapshot/', [CameraController::class, "snapshot"])->name('api.snapshot');

