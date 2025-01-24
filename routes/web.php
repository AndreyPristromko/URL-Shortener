<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;
use App\Models\Url;

Route::get('/', function () {
    return view('welcome');
});

// Создание короткой ссылки
Route::post('/url/create', [UrlController::class, 'create']);

// Редирект по короткому тексту
Route::get('/{code}', [UrlController::class, 'redirect']);

// Получение актуального значения счетчика кликов
Route::get('/url/clicks/{code}', [UrlController::class, 'getClickCount']);
