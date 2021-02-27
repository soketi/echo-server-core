<?php

namespace RenokiCo\EchoServer\Test;

use RenokiCo\EchoServer\Models\EchoApp;

class AppsManagerTest extends TestCase
{
    public function test_retrieve_with_array()
    {
        $this->json('GET', route('echo-server.app.show', ['appId' => 'echo-app', 'token' => 'echo-app-token']))
            ->assertOk()
            ->assertJson([
                'app' => [
                    'id' => 'echo-app',
                    'key' => 'echo-app-key',
                    'secret' => 'echo-app-secret',
                    'maxConnections' => -1,
                    'allowedOrigins' => ['*'],
                    'enableStats' => false,
                ],
            ]);

        $this->json('GET', route('echo-server.app.show', ['appKey' => 'echo-app-key', 'token' => 'echo-app-token']))
            ->assertOk()
            ->assertJson([
                'app' => [
                    'id' => 'echo-app',
                    'key' => 'echo-app-key',
                    'secret' => 'echo-app-secret',
                    'maxConnections' => -1,
                    'allowedOrigins' => ['*'],
                    'enableStats' => false,
                ],
            ]);

        $this->json('GET', route('echo-server.app.show', ['appId' => 'echo-app-wrong', 'token' => 'echo-app-token']))
            ->assertNotFound();

        $this->json('GET', route('echo-server.app.show', ['appKey' => 'echo-app-wrong', 'token' => 'echo-app-token']))
            ->assertNotFound();

        $this->json('GET', route('echo-server.app.show', ['appId' => 'echo-app', 'token' => 'echo-app-token-wrong']))
            ->assertUnauthorized();

        $this->json('GET', route('echo-server.app.show', ['appKey' => 'echo-app-key', 'token' => 'echo-app-token-wrong']))
            ->assertUnauthorized();
    }

    public function test_retrieve_with_database()
    {
        $this->app['config']->set('echo-server.app-manager.driver', 'database');

        $app = factory(EchoApp::class)->create([
            'key' => 'echo-app-key',
            'secret' => 'echo-app-secret',
            'max_connections' => 100,
            'allowed_origins' => ['*.test.com'],
            'enable_stats' => true,
        ]);

        $this->json('GET', route('echo-server.app.show', ['appId' => $app->id, 'token' => 'echo-app-token']))
            ->assertOk()
            ->assertJson([
                'app' => [
                    'id' => $app->id,
                    'key' => $app->key,
                    'secret' => $app->secret,
                    'maxConnections' => $app->max_connections,
                    'allowedOrigins' => $app->allowed_origins,
                    'enableStats' => $app->enable_stats,
                ],
            ]);

        $this->json('GET', route('echo-server.app.show', ['appKey' => $app->key, 'token' => 'echo-app-token']))
            ->assertOk()
            ->assertJson([
                'app' => [
                    'id' => $app->id,
                    'key' => $app->key,
                    'secret' => $app->secret,
                    'maxConnections' => $app->max_connections,
                    'allowedOrigins' => $app->allowed_origins,
                    'enableStats' => $app->enable_stats,
                ],
            ]);

        $this->json('GET', route('echo-server.app.show', ['appId' => 'echo-app-wrong', 'token' => 'echo-app-token']))
            ->assertNotFound();

        $this->json('GET', route('echo-server.app.show', ['appKey' => 'echo-app-wrong', 'token' => 'echo-app-token']))
            ->assertNotFound();

        $this->json('GET', route('echo-server.app.show', ['appId' => 'echo-app', 'token' => 'echo-app-token-wrong']))
            ->assertUnauthorized();

        $this->json('GET', route('echo-server.app.show', ['appKey' => 'echo-app', 'token' => 'echo-app-token-wrong']))
            ->assertUnauthorized();
    }
}
