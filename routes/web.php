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



Route::get('/api/users/{ip}', [CameraController::class, "users"])->name('api.users');
Route::get('/api/storage/{ip}', [CameraController::class, "storage"])->name('api.storage');
Route::get('/api/cameras/{ip}', [CameraController::class, "cameras"])->name('api.cameras');
Route::get('/api/connected/{ip}', [CameraController::class, "cameras"])->name('api.connected');

