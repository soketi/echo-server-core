<?php

namespace Soketi\EchoServer\Models;

use Illuminate\Database\Eloquent\Model;

class EchoApp extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $guarded = [];

    /**
     * {@inheritdoc}
     */
    protected $hidden = [
        'secret',
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'max_connections' => 'int',
        'enable_stats' => 'bool',
        'enable_client_messages' => 'bool',
        'max_backend_events_per_min' => 'int',
        'max_client_events_per_min' => 'int',
        'max_read_req_per_min' => 'int',
    ];
}
