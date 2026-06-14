<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => response()->json(['app' => 'Student MS API', 'version' => '1.0.0']));
