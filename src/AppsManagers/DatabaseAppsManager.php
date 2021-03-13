<?php

namespace Soketi\EchoServer\AppsManagers;

class DatabaseAppsManager extends ArrayAppsManager
{
    /**
     * Find an application by ID.
     *
     * @param  string  $appId
     * @return null|\Soketi\EchoServer\AppsManagers\App
     */
    public function findById(string $appId)
    {
        $model = config('echo-server.app-manager.database.model');

        $app = $model::find($appId);

        if (! $app) {
            return null;
        }

        return $this->toApp($app);
    }

    /**
     * Find an application by ID.
     *
     * @param  string  $appKey
     * @return null|\Soketi\EchoServer\AppsManagers\App
     */
    public function findByKey(string $appKey)
    {
        $model = config('echo-server.app-manager.database.model');

        $app = $model::where('key', $appKey)->first();

        if (! $app) {
            return null;
        }

        return $this->toApp($app);
    }

    /**
     * Get an App instance from mode.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $app
     * @return \Soketi\EchoServer\AppsManagers\App
     */
    protected function toApp($app)
    {
        return new App(
            $app->id,
            $app->key,
            $app->secret,
            $app->max_connections,
            $app->enable_stats
        );
    }
}
