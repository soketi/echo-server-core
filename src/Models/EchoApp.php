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
        'enable_stats' => 'bool',
    ];
}
