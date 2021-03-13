<?php

use Illuminate\Support\Str;

$factory->define(\Soketi\EchoServer\Models\EchoApp::class, function () {
    return [
        'key' => Str::random(32),
        'secret' => Str::random(32),
        'max_connections' => -1,
        'enable_stats' => false,
    ];
});
