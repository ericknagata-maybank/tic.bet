<?php
use App\Http\Controllers\Gateway\MaybankController;
use Illuminate\Support\Facades\Route;

Route::prefix('maybank')
    ->group(function ()
    {
        Route::post('qrcode-pix', [MaybankController::class, 'getQRCodePix']);
        Route::post('consult-status-transaction', [MaybankController::class, 'consultStatusTransactionPix']);
    });

    
    
    
    