<?php

use Illuminate\Support\Str;

$factory->define(\Soketi\EchoServer\Models\EchoApp::class, function () {
    return [
        'key' => Str::random(32),
        'secret' => Str::random(32),
        'max_connections' => -1,
        'enable_stats' => false,
        'enable_client_messages' => true,
        'max_backend_events_per_min' => -1,
        'max_client_events_per_min' => -1,
        'max_read_req_per_min' => -1,
    ];
});
