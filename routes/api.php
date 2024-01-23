<?php

use App\Http\Controllers\ControllerAlamat;
use App\Http\Controllers\ControllerDataBPJS;
use App\Http\Controllers\ControllerDataNIK;
use App\Http\Controllers\ControllerDatapbb;
use App\Http\Controllers\ControllerDataPDAM;
use App\Http\Controllers\ControllerDataPGN;
use App\Http\Controllers\ControllerDataPLN;
use App\Http\Controllers\ControllerDataSTNK;
use App\Http\Controllers\ControllerPaymentDana;
use App\Http\Controllers\ControllerPaymentGopay;
use App\Http\Controllers\ControllerPaymentOvo;
use App\Http\Controllers\ControllerTagihanBPJS;
use App\Http\Controllers\ControllerTagihanpbb;
use App\Http\Controllers\ControllerTagihanPGN;
use App\Http\Controllers\ControllerTagihanKendaraan;
use App\Http\Controllers\ControllerTagihanPLN;
use App\Http\Controllers\ControllerTagihanPDAM;
use App\Http\Controllers\ControllerTagihanUser;
use App\Http\Controllers\DataKartuController;
use App\Http\Controllers\DataTagihanController;
use App\Http\Controllers\DemoAppController;
use App\Http\Controllers\HistoryTagihanController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\TagihanTerdaftarController;
use App\Http\Controllers\TagihanTersediaController;
use App\Http\Controllers\UserController;
use App\Models\PaymentDana;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/users')->group(function() 
{
    // Route::get('/show', [UserController::class, 'showAll']);
    // Route::get('/show/{id}', [UserController::class, 'showSpesific']);
    // Route::post('/post', [UserController::class, 'store']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::delete('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/show', [UserController::class, 'show'])->middleware('auth:sanctum');
    // Route::post('/edit/{id}', [UserController::class, 'edit']);
    // Route::delete('/delete/{id}', [UserController::class, 'delete']);
});

// Tagihan BPJS
Route::get('/tagihan-bpjs', [ControllerTagihanBPJS::class, 'index']);
Route::post('/tagihan-bpjs/store', [ControllerTagihanBPJS::class, 'store']);
Route::post('/tagihan-bpjs/detail', [ControllerTagihanBPJS::class, 'show']);
Route::post('/tagihan-bpjs/put', [ControllerTagihanBPJS::class, 'update']);
Route::delete('/tagihan-bpjs/delete', [ControllerTagihanBPJS::class, 'destroy']);

// Tagihan PBB
Route::get('/tagihan-pbb', [ControllerTagihanPBB::class, 'index']);
Route::post('/tagihan-pbb/store', [ControllerTagihanPBB::class, 'store']);
Route::post('/tagihan-pbb/detail', [ControllerTagihanPBB::class, 'show']);
Route::post('/tagihan-pbb/put', [ControllerTagihanPBB::class, 'update']);
Route::delete('/tagihan-pbb/delete', [ControllerTagihanPBB::class, 'destroy']);

// Tagihan Gas
Route::get('/tagihan-gas', [ControllerTagihanPGN::class, 'index']);
Route::post('/tagihan-gas/store', [ControllerTagihanPGN::class, 'store']);
Route::post('/tagihan-gas/detail', [ControllerTagihanPGN::class, 'show']);
Route::post('/tagihan-gas/put', [ControllerTagihanPGN::class, 'update']);
Route::delete('/tagihan-gas/delete', [ControllerTagihanPGN::class, 'destroy']);

// Tagihan Kendaraan
Route::get('/tagihan-kendaraan', [ControllerTagihanKendaraan::class, 'index']);
Route::post('/tagihan-kendaraan', [ControllerTagihanKendaraan::class, 'store']);
Route::post('/tagihan-kendaraan/{tagihanKendaraan}', [ControllerTagihanKendaraan::class, 'show']);
Route::post('/tagihan-kendaraan/{tagihanKendaraan}', [ControllerTagihanKendaraan::class, 'update']);
Route::delete('/tagihan-kendaraan/{tagihanKendaraan}', [ControllerTagihanKendaraan::class, 'destroy']);

// Tagihan Listrik PLN
Route::get('/tagihan-pln', [ControllerTagihanPLN::class, 'index']);
Route::post('/tagihan-pln/store', [ControllerTagihanPLN::class, 'store']);
Route::post('/tagihan-pln/detail', [ControllerTagihanPLN::class, 'show']);
Route::post('/tagihan-pln/put', [ControllerTagihanPLN::class, 'update']);
Route::delete('/tagihan-pln/delete', [ControllerTagihanPLN::class, 'destroy']);

// Tagihan PDAM
Route::get('/tagihan-pdam', [ControllerTagihanPDAM::class, 'index']);
Route::post('/tagihan-pdam/store', [ControllerTagihanPDAM::class, 'store']);
Route::post('/tagihan-pdam/detail', [ControllerTagihanPDAM::class, 'show']);
Route::post('/tagihan-pdam/put', [ControllerTagihanPDAM::class, 'update']);
Route::delete('/tagihan-pdam/delete', [ControllerTagihanPDAM::class, 'destroy']);

// Tagihan STNK
Route::get('/tagihan-stnk', [ControllerTagihanKendaraan::class, 'index']);
Route::post('/tagihan-stnk/store', [ControllerTagihanKendaraan::class, 'store']);
Route::post('/tagihan-stnk/detail', [ControllerTagihanKendaraan::class, 'show']);
Route::post('/tagihan-stnk/put', [ControllerTagihanKendaraan::class, 'update']);
Route::delete('/tagihan-stnk/delete', [ControllerTagihanKendaraan::class, 'destroy']);

// Tagihan User
Route::get('/tagihan-user', [ControllerTagihanUser::class, 'index']);
Route::post('/tagihan-user/store', [ControllerTagihanUser::class, 'store']);
Route::post('/tagihan-user/detail', [ControllerTagihanUser::class, 'show']);
Route::post('/tagihan-user/put', [ControllerTagihanUser::class, 'update']);
Route::delete('/tagihan-user/delete', [ControllerTagihanUser::class, 'destroy']);

// Alamat
Route::get('/alamat', [ControllerAlamat::class, 'index']);
Route::get('/alamat/show/{id}', [ControllerAlamat::class, 'show'])->middleware('auth:sanctum');
Route::get('/alamat/show-all', [ControllerAlamat::class, 'showAll'])->middleware('auth:sanctum');
Route::post('/alamat/store', [ControllerAlamat::class, 'store'])->middleware('auth:sanctum');
Route::put('/alamat/put/{id}', [ControllerAlamat::class, 'update'])->middleware('auth:sanctum');
Route::delete('/alamat/delete/{id}', [ControllerAlamat::class, 'destroy'])->middleware('auth:sanctum');

// Data
Route::post('/data-pbb/store', [ControllerDatapbb::class, 'store']);
Route::post('/data-stnk/store', [ControllerDataSTNK::class, 'store']);
Route::get('/data-stnk/show/{id}', [ControllerDataSTNK::class, 'show']);
Route::post('/data-pln/store', [ControllerDataPLN::class, 'store']);
Route::post('/data-pdam/store', [ControllerDataPDAM::class, 'store']);
Route::post('/data-bpjs/store', [ControllerDataBPJS::class, 'store']);
Route::post('/data-pgn/store', [ControllerDataPGN::class, 'store']);

// Data Tagihan
Route::post('/data-tagihan/store', [DataTagihanController::class, 'store']);

// Data Kartu
Route::post('/data-kartu/store', [DataKartuController::class, 'store']);

// Tagihan Tersedia
Route::get('/tagihan-tersedia/show-all', [TagihanTersediaController::class, 'showAll'])->middleware('auth:sanctum');
Route::post('/tagihan-tersedia/store', [TagihanTersediaController::class, 'store'])->middleware('auth:sanctum');
Route::get('/tagihan-tersedia/show-total', [TagihanTersediaController::class, 'showTotalTagihan'])->middleware('auth:sanctum');

// Metode Pembayaran
Route::get('/metode-pembayaran', [MetodePembayaranController::class, 'index'])->middleware('auth:sanctum');
Route::get('/metode-pembayaran/show-all', [MetodePembayaranController::class, 'showAll'])->middleware('auth:sanctum');
Route::post('/metode-pembayaran/store-kartu', [MetodePembayaranController::class, 'storeKartu'])->middleware('auth:sanctum');
Route::put('/metode-pembayaran/change-pembayaran-utama/{id}', [MetodePembayaranController::class, 'changePembayaranUtama'])->middleware('auth:sanctum');
Route::delete('/metode-pembayaran/delete/{id}', [MetodePembayaranController::class, 'destroy'])->middleware('auth:sanctum');

// History Tagihan
Route::get('/history-tagihan/show-all', [HistoryTagihanController::class, 'showAll'])->middleware('auth:sanctum');
Route::post('/history-tagihan/store', [HistoryTagihanController::class, 'store']);

// Demo
Route::get('/demo/reset', [DemoAppController::class, 'reset']);

// Tagihan Terdaftar
Route::prefix('/tagihan-terdaftar')->group(function() 
{
    Route::post('/store-pbb', [TagihanTerdaftarController::class, 'storepbb'])->middleware('auth:sanctum');
    Route::post('/store-pln', [TagihanTerdaftarController::class, 'storePLN'])->middleware('auth:sanctum');
    Route::post('/store-pgn', [TagihanTerdaftarController::class, 'storePGN'])->middleware('auth:sanctum');
    Route::post('/store-pdam', [TagihanTerdaftarController::class, 'storePDAM'])->middleware('auth:sanctum');
    Route::post('/store-bpjs', [TagihanTerdaftarController::class, 'storeBPJS'])->middleware('auth:sanctum');
    Route::post('/store-motor', [TagihanTerdaftarController::class, 'storeMotor'])->middleware('auth:sanctum');
    Route::post('/store-mobil', [TagihanTerdaftarController::class, 'storeMobil'])->middleware('auth:sanctum');
    Route::post('/verifikasi-kendaraan', [TagihanTerdaftarController::class, 'verifikasiKendaraan'])->middleware('auth:sanctum');
    Route::put('/update/{id}', [TagihanTerdaftarController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/delete/{id}', [TagihanTerdaftarController::class, 'destroy'])->middleware('auth:sanctum');
    Route::get('/show-all', [TagihanTerdaftarController::class, 'showAll'])->middleware('auth:sanctum');
});