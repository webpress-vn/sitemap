<?php

namespace VCComponent\Laravel\Sitemap\Http\Controllers\Web;

use Illuminate\Routing\Controller as BaseController;

class SitemapController extends BaseController
{
    public function __construct()
    {

        if (config('sitemap.file.sitemap') !== null) {
            $this->sitemap = config('sitemap.file.sitemap');
        } else {
            $this->sitemap = storage_path('sitemap\sitemap.xml');
        }
    }

    public function __invoke()
    {
        if(file_exists($this->sitemap) == false ){
            return 'Site map does not exists !';
        }
        return response()->file($this->sitemap);
    }
}
