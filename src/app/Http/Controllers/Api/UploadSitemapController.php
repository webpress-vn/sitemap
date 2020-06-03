<?php

namespace VCComponent\Laravel\Sitemap\Http\Controllers\Api;

use Illuminate\Http\Request;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;

class UploadSitemapController extends ApiController
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
            $this->sitemap = storage_path('sitemap/sitemap.xml');
        }
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'sitemap' => 'required',
        ]);

        $file_name   = "sitemap.xml";
        $path        = str_replace($file_name, '', $this->sitemap);

        if (file_exists($this->sitemap) == true) {
            $old_sitemap = $path.'sitemap-' . date('Y-m-d') . '.xml';
            copy($this->sitemap, $this->sitemap . ".bak");
            rename($this->sitemap, $old_sitemap);
        }

        $create_file = $request->file('sitemap')->move($path, $file_name);
        $url         = url('/' . $file_name);

        return response()->json(['url' => $url]);
    }
}
