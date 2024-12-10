<?php

use App\Http\Controllers\Gateway\pagamento_antigo_anderson_chinesController;
use Illuminate\Support\Facades\Route;

Route::prefix('pagamento_antigo_anderson_chines')
    ->group(function ()
    {
        Route::post('qrcode-pix', [pagamento_antigo_anderson_chinesController::class, 'getQRCodePix']);
        Route::post('consult-status-transaction', [pagamento_antigo_anderson_chinesController::class, 'consultStatusTransactionPix']);
    });



