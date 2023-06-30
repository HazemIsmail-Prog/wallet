<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\SettingsController;
use App\Http\Livewire\TransactionForm;
use App\Http\Livewire\TransactionIndex;
use App\Http\Livewire\WalletIndex;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/settings' , [SettingsController::class,'index'])->name('settings');
    Route::resource('/countries' , CountryController::class);
    
    Route::middleware('check_country')->group(function(){
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::get('/wallets', WalletIndex::class)->name('wallets.index');
        Route::get('/transaction/{wallet}/{transaction?}/', TransactionForm::class)->name('transaction.form');
        Route::get('/transactions', TransactionIndex::class)->name('transactions.index');
    });
});
