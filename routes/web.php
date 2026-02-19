<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

Route::resource('invoices', InvoiceController::class);
Route::redirect('/', '/invoices');

// Your resource route (keep this)
