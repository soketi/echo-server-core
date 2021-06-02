<?php

namespace Soketi\EchoServer\Test;

use Soketi\EchoServer\Models\EchoApp;

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
                    'enableStats' => false,
                    'enableClientMessages' => true,
                    'maxBackendEventsPerMinute' => -1,
                    'maxClientEventsPerMinute' => -1,
                    'maxReadRequestsPerMinute' => -1,
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
                    'enableStats' => false,
                    'enableClientMessages' => true,
                    'maxBackendEventsPerMinute' => -1,
                    'maxClientEventsPerMinute' => -1,
                    'maxReadRequestsPerMinute' => -1,
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
            'enable_stats' => true,
            'enable_client_messages' => true,
            'max_backend_events_per_min' => -1,
            'max_client_events_per_min' => -1,
            'max_read_req_per_min' => -1,
        ]);

        $this->json('GET', route('echo-server.app.show', ['appId' => $app->id, 'token' => 'echo-app-token']))
            ->assertOk()
            ->assertJson([
                'app' => [
                    'id' => $app->id,
                    'key' => $app->key,
                    'secret' => $app->secret,
                    'maxConnections' => $app->max_connections,
                    'enableStats' => $app->enable_stats,
                    'enableClientMessages' => $app->enable_client_messages,
                    'maxBackendEventsPerMinute' => $app->max_backend_events_per_min,
                    'maxClientEventsPerMinute' => $app->max_client_events_per_min,
                    'maxReadRequestsPerMinute' => $app->max_read_req_per_min,
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
                    'enableStats' => $app->enable_stats,
                    'enableClientMessages' => $app->enable_client_messages,
                    'maxBackendEventsPerMinute' => $app->max_backend_events_per_min,
                    'maxClientEventsPerMinute' => $app->max_client_events_per_min,
                    'maxReadRequestsPerMinute' => $app->max_read_req_per_min,
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
