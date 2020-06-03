<?php

Route::prefix(config('sitemap.namespace'))->middleware('web')
    ->group(function () {
        Route::get('/sitemap.xml', 'VCComponent\Laravel\Sitemap\Http\Controllers\Web\SitemapController');
    });
