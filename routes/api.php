<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SitemapURLController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/sitemaps/create', function() {
    set_time_limit(0);
    Artisan::call('sitemap:generate');
    set_time_limit(60);

    return [
        "message" => "Sitemaps gerados!!"
    ];
});
