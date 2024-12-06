<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

  
use App\Http\Controllers\AuthController;
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Hanya bisa diakses jika user memiliki token yang valid
Route::middleware('auth:api')->get('/user', [AuthController::class, 'getAuthenticatedUser']);

use App\Http\Controllers\UserController;
// Route untuk menambahkan user (hanya admin)
Route::middleware('auth:api', 'role:admin')->post('/user/create', [UserController::class, 'createUser']);
// Route untuk mengubah data user (hanya admin atau user yang bersangkutan)
Route::middleware('auth:api', 'role:admin')->put('/user/{id}', [UserController::class, 'updateUser']);
// Route untuk mengambil data user berdasarkan ID
Route::middleware('auth:api')->get('/user/{id}', [UserController::class, 'getUserById']);
// Route untuk menghapus data user (hanya admin)
Route::middleware('auth:api','role:admin')->delete('/user/{id}',[UserController::class,'deleteuser']);
Route::middleware('auth:api','role:admin')->get('/user',[UserController::class,'getall']);


 use App\Http\Controllers\PresenceController;
 Route::middleware('auth:api')->post('/presensi', [PresenceController::class, 'store']);
Route::get('/presensi/riwayat', [PresenceController::class, 'riwayat'])->middleware(['auth:api', 'role:admin,siswa']);
Route::get('/presensi/riwayat/{user_id}', [PresenceController::class, 'riwayatByUserId'])->middleware(['auth:api', 'role:admin']);