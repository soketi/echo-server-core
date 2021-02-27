<?php

namespace Renokico\EchoServer\Contracts;

interface AppsManager
{
    /**
     * Find an application by ID.
     *
     * @param  string  $appId
     * @return null|\RenokiCo\EchoServer\AppsManagers\App
     */
    public function findById(string $appId);

    /**
     * Find an application by ID.
     *
     * @param  string  $appKey
     * @return null|\RenokiCo\EchoServer\AppsManagers\App
     */
    public function findByKey(string $appKey);
}
