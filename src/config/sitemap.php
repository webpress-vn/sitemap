<?php

return [
    'namespace'       => env('SITEMAP_COMPONENT_NAMESPACE', 'sitemap-management'),

    'file'            => [
        'sitemap' => storage_path('sitemap.xml'),
    ],

    'auth_middleware' => [
        'admin' => [
            'middleware' => '',
        ],
    ],
];
