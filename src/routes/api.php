<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => config('sitemap.namespace')], function ($api) {
        $api->post("/sitemap", 'VCComponent\Laravel\Sitemap\Http\Controllers\Api\UploadSitemapController');
        $api->put("/sitemap", 'VCComponent\Laravel\Sitemap\Http\Controllers\Api\RollbackSitemapController');
    });
});
