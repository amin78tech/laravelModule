<?php
use Illuminate\Support\Facades\Route;

Route::get('mehdi', [\Moldule\auth\http\controllers\TestController::class, 'test',]);
