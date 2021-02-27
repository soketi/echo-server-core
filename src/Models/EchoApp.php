<?php

namespace RenokiCo\EchoServer\Models;

use Illuminate\Database\Eloquent\Model;
use RenokiCo\UsefulCasts\Casts\Arrayed;

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
        'allowed_origins' => Arrayed::class,
        'enable_stats' => 'bool',
    ];
}
