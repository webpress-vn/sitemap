<?php

namespace VCComponent\Laravel\Sitemap\Http\Controllers\Api;

use Illuminate\Http\Request;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;
use VCComponent\Laravel\Vicoders\Core\Exceptions\PermissionDeniedException;

class RollbackSitemapController extends ApiController
{
    public function __construct()
    {
        if (config('sitemap.auth_middleware.admin.middleware') !== null) {
            $user = $this->getAuthenticatedUser();
            if (!$this->entity->ableToShow($user, $id)) {
                throw new PermissionDeniedException();
            }
        }

        if (config('sitemap.file.sitemap') !== null) {
            $this->sitemap = config('sitemap.file.sitemap');
        } else {
            $this->sitemap = storage_path('sitemap\sitemap.xml');
        }
    }

    public function __invoke()
    {
        if (file_exists($this->sitemap) == false) {
            return "Site map does not exists !";
        }

        $file_name = "sitemap.xml";
        $path      = str_replace($file_name, '', $this->sitemap);

        if (file_exists($this->sitemap . ".bak")) {
            $old_sitemap = $path . 'sitemap-' . date('Y-m-d') . '.xml';
            copy($this->sitemap, $this->sitemap . ".trash");
            rename($this->sitemap, $old_sitemap);
            rename($this->sitemap . ".bak", $this->sitemap);
            rename($this->sitemap . ".trash", $this->sitemap . ".bak");
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }
}
