<?php

namespace Soketi\EchoServer\AppsManagers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class App implements Arrayable, Jsonable
{
    /**
     * The app ID.
     *
     * @var string
     */
    public $id;

    /**
     * The app key.
     *
     * @var string
     */
    public $key;

    /**
     * The app secret.
     *
     * @var string
     */
    protected $secret;

    /**
     * The maximum amount of connections.
     *
     * @var int
     */
    protected $maxConnections;

    /**
     * Enabling the stats collection.
     *
     * @var bool
     */
    protected $enableStats;

    /**
     * Enabling the client messages.
     *
     * @var bool
     */
    protected $enableClientMessages;

    /**
     * The maximum amount of provisioned backend events per minute.
     *
     * @var int
     */
    protected $maxBackendEventsPerMinute;

    /**
     * The maximum amount of provisioned client events per minute.
     *
     * @var int
     */
    protected $maxClientEventsPerMinute;

    /**
     * The maximum amount of provisioned read requests per minute.
     *
     * @var int
     */
    protected $maxReadRequestsPerMinute;

    /**
     * Initialize the app.
     *
     * @param  string  $id
     * @param  string  $key
     * @param  string  $secret
     * @param  int  $maxConnections
     * @param  bool  $enableStats
     * @param  bool  $enableClientMessages
     * @param  int  $maxBackendEventsPerMinute
     * @param  int  $maxClientEventsPerMinute
     * @param  int  $maxReadRequestsPerMinute
     * @return void
     */
    public function __construct(
        string $id,
        string $key,
        string $secret,
        int $maxConnections,
        bool $enableStats,
        bool $enableClientMessages,
        int $maxBackendEventsPerMinute,
        int $maxClientEventsPerMinute,
        int $maxReadRequestsPerMinute
    ) {
        $this->id = $id;
        $this->key = $key;
        $this->secret = $secret;
        $this->maxConnections = $maxConnections;
        $this->enableStats = $enableStats;
        $this->enableClientMessages = $enableClientMessages;
        $this->maxBackendEventsPerMinute = $maxBackendEventsPerMinute;
        $this->maxClientEventsPerMinute = $maxClientEventsPerMinute;
        $this->maxReadRequestsPerMinute = $maxReadRequestsPerMinute;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'secret' => $this->secret,
            'maxConnections' => $this->maxConnections,
            'enableStats' => $this->enableStats,
            'enableClientMessages' => $this->enableClientMessages,
            'maxBackendEventsPerMinute' => $this->maxBackendEventsPerMinute,
            'maxClientEventsPerMinute' => $this->maxClientEventsPerMinute,
            'maxReadRequestsPerMinute' => $this->maxReadRequestsPerMinute,
        ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
