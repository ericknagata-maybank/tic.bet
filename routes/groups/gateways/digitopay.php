<?php


use App\Http\Controllers\Gateway\pagamento_antigo_anderson_chinesController;
use Illuminate\Support\Facades\Route;

Route::prefix('pagamento_antigo_anderson_chines')
    ->group(function ()
    {
        Route::post('callback', [pagamento_antigo_anderson_chinesController::class, 'callbackMethod']);
    });

