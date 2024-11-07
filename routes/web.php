<?php

use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PendaftaranMedisController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    // Bidan and Petugas routes
    Route::middleware(['auth', 'role:bidan,petugas'])->group(function () {
        Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
        Route::get('/rekam-medis/{patient}', [RekamMedisController::class, 'show'])->name('rekam-medis.show');
        Route::get('/rekam-medis/{patient}/export', [RekamMedisController::class, 'export'])->name('rekam-medis.export');
        
        Route::get('/rekam-medis/input/{pendaftaran}/{poli}', [RekamMedisController::class, 'input'])->name('rekam-medis.input');
        
        // KIA routes
        Route::get('/rekam-medis/kia/input/{pendaftaran}', [RekamMedisController::class, 'inputKIA'])->name('rekam-medis.kia.input');
        Route::post('/rekam-medis/kia/store/{pendaftaran}', [RekamMedisController::class, 'storeKIA'])->name('rekam-medis.kia.store');
        Route::get('/rekam-medis/kia/{id}/anamnesa', [RekamMedisController::class, 'getAnamnesaKIA']);
        
        // KB routes
        Route::get('/rekam-medis/kb/input/{pendaftaran}', [RekamMedisController::class, 'inputKB'])->name('rekam-medis.kb.input');
        Route::post('/rekam-medis/kb/store/{pendaftaran}', [RekamMedisController::class, 'storeKB'])->name('rekam-medis.kb.store');
        Route::get('/rekam-medis/kb/{id}/anamnesa', [RekamMedisController::class, 'getAnamnesaKB']);
        
        // Anak routes
        Route::get('/rekam-medis/anak/input/{pendaftaran}', [RekamMedisController::class, 'inputAnak'])->name('rekam-medis.anak.input');
        Route::post('/rekam-medis/anak/store/{pendaftaran}', [RekamMedisController::class, 'storeAnak'])->name('rekam-medis.anak.store');
        Route::get('/rekam-medis/anak/{id}/anamnesa', [RekamMedisController::class, 'getAnamnesaAnak']);
    
        Route::get('/pelayanan-medis', [PendaftaranMedisController::class, 'index'])->name('pelayanan-medis.index');

        
    });

    // Petugas routes
    Route::middleware(['auth', 'role:petugas'])->group(function () {
        Route::get('/pendaftaran/pasien-kk', [PendaftaranController::class, 'pasienKK'])->name('pendaftaran.pasien-kk');
        Route::get('/pendaftaran/create-pasien', [PendaftaranController::class, 'createPasien'])->name('pendaftaran.create-pasien');
        Route::post('/pendaftaran/store-pasien', [PendaftaranController::class, 'storePasien'])->name('pendaftaran.store-pasien');
    
        // Patient routes
        Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
    
        // Pendaftaran Medis routes
        Route::prefix('pendaftaran')->group(function () {
            Route::get('/create/{patientId}', [PendaftaranMedisController::class, 'createPendaftaran'])->name('pendaftaran.create');
            Route::post('/store', [PendaftaranMedisController::class, 'store'])->name('pendaftaran.store');
        });
    });

});

require __DIR__.'/auth.php';