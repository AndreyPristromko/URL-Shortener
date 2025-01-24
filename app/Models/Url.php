<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    // Разрешенные для заполнения поля
    protected $fillable = [
        'url',
        'short_url',
        'clicks'
    ];

    // Правила проверки данных
    public static $rules = [
        'url' => 'required|url|max:255',
        'short_url' => 'required|unique:urls|max:50'
    ];

    // Преобразование типов данных
    protected $casts = [
        'clicks' => 'integer'
    ];

    // Начальные значения для новых ссылок
    protected $attributes = [
        'clicks' => 0
    ];

    // Считаем количество переходов по ссылке
    public function countClick()
    {
        $this->increment('clicks');
    }

    // Формируем короткую ссылку
    public function getShortLink()
    {
        return url('/') . '/' . $this->short_url;
    }
}
