<?php

$config = [
    'qkids_api_uri' => getenv('QKIDS_API_URI'),
    'assets_per_page' => (int)getenv('ASSETS_PER_PAGE'),

    'base_path' => realpath(__DIR__ . '/../../')
];

return $config;
