<?php


use App\Http\Controllers\Gateway\MaybankController;
use Illuminate\Support\Facades\Route;


Route::prefix('maybank')
    ->group(function ()
    {
        Route::get('withdrawal/{id}/{action}', [MaybankController::class, 'withdrawalFromModal'])->name('maybank.withdrawal');
        Route::get('cancelwithdrawal/{id}/{action}', [MaybankController::class, 'cancelWithdrawalFromModal'])->name('maybank.cancelwithdrawal');
        Route::post('callback', [MaybankController::class, 'callbackMethod']);
        Route::post('payment', [MaybankController::class, 'callbackMethodPayment']);
        
    });
