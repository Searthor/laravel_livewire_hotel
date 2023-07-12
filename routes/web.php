<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboarController;
use App\Http\Livewire\Admin\ManageRoots;
use App\Http\Livewire\Admin\Reservation;
use App\Http\Livewire\Admin\RoomTpye;
use App\Http\Livewire\Admin\Staff;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PrintController;
use App\Http\Livewire\Admin\HistoryOfStay;

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
    return view('welcome');
});



// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', DashboarController::class)->name('dashboard');

    Route::get('/reservation', Reservation::class)->name('reservation');
    Route::get('/manage_rooms', ManageRoots::class)->name('manage_rooms');
    Route::get('/rooms_type', RoomTpye::class)->name('rooms_type');
    Route::get('/staff', Staff::class)->name('staff');
    Route::get('/history-of-stay', HistoryOfStay::class)->name('history-of-stay');
    Route::get('generate-pdf', [PDFController::class, 'generatePDF'])->name('generate-pdf');
    Route::get('print', [PrintController::class, 'printhistoryStay'])->name('print');
    
    
    
});

require __DIR__ . '/auth.php';
