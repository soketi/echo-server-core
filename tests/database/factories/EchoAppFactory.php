<?php

use Illuminate\Support\Str;

$factory->define(\RenokiCo\EchoServer\Models\EchoApp::class, function () {
    return [
        'key' => Str::random(32),
        'secret' => Str::random(32),
        'max_connections' => -1,
        'allowed_origins' => ['*'],
        'enable_stats' => false,
    ];
});
