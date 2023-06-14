<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

Route::middleware('api')->match(['get', 'post'], '/api/postcodeservice', function (Request $request) {
    $request->merge([
        'postcode' => strtoupper(str_replace(' ', '', $request->json('postcode'))),
    ])->validate([
        'postcode' => 'required|string|max:6',
        'house_number' => 'required',
    ]);

    $cacheKey = 'postcodeservice-'.$request->json('postcode').'-'.$request->json('house_number');

    return Cache::rememberForever($cacheKey, function () use ($request) {
        return Http::postcodeservice()->get('/nl/v5/getAddress', [
            'zipcode'=> $request->json('postcode'),
            'houseno'=> $request->json('house_number'),
        ])->throw()->json();
    });
});
