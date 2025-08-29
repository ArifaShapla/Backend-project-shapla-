<?php

use App\Http\Controllers\GroceryItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('grocery-items.index');
});

Route::resource('grocery-items', GroceryItemController::class);