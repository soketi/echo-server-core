<?php

namespace Soketi\EchoServer\AppsManagers;

use Soketi\EchoServer\Contracts\AppsManager;

class ArrayAppsManager implements AppsManager
{
    /**
     * Find an application by ID.
     *
     * @param  string  $appId
     * @return null|\Soketi\EchoServer\AppsManagers\App
     */
    public function findById(string $appId)
    {
        $app = collect(config('echo-server.app-manager.array.apps'))
            ->where('id', $appId)
            ->first();

        if (! $app) {
            return null;
        }

        return $this->toApp($app);
    }

    /**
     * Find an application by key.
     *
     * @param  string  $appKey
     * @return null|\Soketi\EchoServer\AppsManagers\App
     */
    public function findByKey(string $appKey)
    {
        $app = collect(config('echo-server.app-manager.array.apps'))
            ->where('key', $appKey)
            ->first();

        if (! $app) {
            return null;
        }

        return $this->toApp($app);
    }

    /**
     * Get an App instance from array.
     *
     * @param  array  $app
     * @return \Soketi\EchoServer\AppsManagers\App
     */
    protected function toApp(array $app)
    {
        return new App(
            $app['id'],
            $app['key'],
            $app['secret'],
            $app['maxConnections'] ?? -1,
            $app['enableStats'] ?? false
        );
    }
}
