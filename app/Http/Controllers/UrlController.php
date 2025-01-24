<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;

class UrlController extends Controller
{   

    public function create(Request $request) {
        $request->validate([
            'url' => 'required|url|max:255'
        ]);

        $shortUrl = $this->makeUrl();

        $url = Url::create([
            'url' => $request->url,
            'short_url' => $shortUrl
        ]);

        return response()->json([
            'short_url' => $url->getShortLink(),
            'click_count' => $url->clicks
        ]);
    }

    public function makeUrl() {
        do {
            $shortUrl = Str::random(6);
        } while (Url::where('short_url', $shortUrl)->exists());

        return $shortUrl;
    }

    public function redirect($code) {
        $url = Url::where('short_url', $code)->firstOrFail();
        // Увеличиваем счетчик кликов
        $url->increment('clicks');
        return redirect($url->url);
    }

    public function getClickCount($code)
    {
        $url = Url::where('short_url', $code)->firstOrFail();
        
        return response()->json([
            'click_count' => $url->clicks
        ]);
    }
}
