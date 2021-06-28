### The application is now deprecated (security issues-only)

It will not receive any new feature updates. Please consider using [soketi/pws](https://github.com/soketi/pws), an all-in-one Pusher server equivalent for Echo Server that is written in C and ported to Node.js by [the awesome guys at uNetworking/uWebSockets.js](https://github.com/uNetworking/uWebSockets.js/blob/master/src/uws.js).

This application had implementation flaws by using both Pusher and Socket.IO and was a really bad idea. The versions before the deprecation announcement are still working and available for you to use.

Echo Server Core
================

![CI](https://github.com/soketi/echo-server-core/workflows/CI/badge.svg?branch=master)
[![codecov](https://codecov.io/gh/soketi/echo-server-core/branch/master/graph/badge.svg)](https://codecov.io/gh/soketi/echo-server-core/branch/master)
[![StyleCI](https://github.styleci.io/repos/342836218/shield?branch=master)](https://github.styleci.io/repos/342836218)
[![Latest Stable Version](https://poser.pugx.org/soketi/echo-server-core/v/stable)](https://packagist.org/packages/soketi/echo-server-core)
[![Total Downloads](https://poser.pugx.org/soketi/echo-server-core/downloads)](https://packagist.org/packages/soketi/echo-server-core)
[![Monthly Downloads](https://poser.pugx.org/soketi/echo-server-core/d/monthly)](https://packagist.org/packages/soketi/echo-server-core)
[![License](https://poser.pugx.org/soketi/echo-server-core/license)](https://packagist.org/packages/soketi/echo-server-core)

Echo Server Core is a Laravel utility package used for Socket.IO-based Echo Server application.

This package is meant to be used with [soketi/echo-server](https://github.com/soketi/echo-server), a fork of Laravel Echo Server, to give a better robustness to the app managers.

## 🤝 Supporting

Renoki Co. on GitHub aims on bringing a lot of open source projects and helpful projects to the world. Developing and maintaining projects everyday is a harsh work and tho, we love it.

If you are using your application in your day-to-day job, on presentation demos, hobby projects or even school projects, spread some kind words about our work or sponsor our work. Kind words will touch our chakras and vibe, while the sponsorships will keep the open source projects alive.

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/R6R42U8CL)

## 🚀 Installation

You can install the package via composer:

```bash
composer require soketi/echo-server-core
```

Publish the config:

```bash
$ php artisan vendor:publish --provider="Soketi\EchoServer\EchoServerServiceProvider" --tag="config"
```

Publish the migrations:

```bash
$ php artisan vendor:publish --provider="Soketi\EchoServer\EchoServerServiceProvider" --tag="migrations"
```

## 🙌 Usage

Out-of-the-box, you benefit a small range of features, like registering routes to retrieve the apps by using the `api` apps manager in Node.js.

If you use the Node.js app in a separate environment or location, the `.env` configurations we get through the docs will not reflect on Node.js app too, so you should additionally configure the Node.js app.

## Apps Manager

Checking the configuration file, you might want to use Echo Server Core's `database` driver alongside with Echo Server's `api` apps manager. To do so, all the .env variables are set so that they are compatible with Echo Server's ones, so you can easily implement the variables in .env and make both Core & Node.js app to use the same configuration.

```env
# Set the database driver on Core
ECHO_SERVER_APPS_MANAGER_DRIVER=database

# Set the API driver on Node.js app
ECHO_SERVER_APPS_MANAGER_DRIVER=api
```

A soft default is set as `array`, meaning that the default driver is the same as the Node.js app, but this time, the array is used from the config file:

```env
ECHO_SERVER_APPS_MANAGER_DRIVER=array

ECHO_SERVER_APP_DEFAULT_ID=echo-app
ECHO_SERVER_APP_DEFAULT_KEY=echo-app-key
ECHO_SERVER_APP_DEFAULT_SECRET=echo-app-secret
ECHO_SERVER_APP_DEFAULT_MAX_CONNS=100
```

## API Manager Security

Since the calls to retrieve the apps are exposing secrets, a token is required to be established between Core & Echo Server app, so that we make sure only the Echo Server has access to them.

You should change the default token for security reasons. It is backwards compatible with the Node.js app, meaning that this will let know the Node.js app about the token too.

```env
ECHO_SERVER_APPS_MANAGER_TOKEN=my-super-secret-token
```

## Echo Broadcaster

This package comes with a custom broadcaster that fixes the issues that normally the Pusher broadcaster has. It supports natively the same Pusher configuration from `broadcasting.php`, but the only thing is that the driver is called `socketio`, and you need to pass additional parameters:

```php
'socketio' => [
    'driver' => 'socketio',
    'key' => env('ECHO_SERVER_APP_DEFAULT_KEY'),
    'secret' => env('ECHO_SERVER_APP_DEFAULT_SECRET'),
    'app_id' => env('ECHO_SERVER_APP_DEFAULT_ID'),
    'options' => [
        'cluster' => 'mt1',
        'encrypted' => true,
        'host' => env('ECHO_SERVER_HOST', '127.0.0.1'),
        'port' => 6001,
        'scheme' => env('ECHO_SERVER_SOCKET_PROTOCOL', 'http'),
        'curl_options' => [
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ],
    ],
],
```

## 🐛 Testing

``` bash
vendor/bin/phpunit
```

## 🤝 Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## 🔒  Security

If you discover any security related issues, please email alex@renoki.org instead of using the issue tracker.

## 🎉 Credits

- [Alex Renoki](https://github.com/rennokki)
- [All Contributors](../../contributors)
