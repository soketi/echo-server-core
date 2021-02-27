<?php

namespace Soketi\EchoServer\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Soketi\EchoServer\AppsManagers\App;
use Soketi\EchoServer\Contracts\AppsManager;
use Soketi\EchoServer\Http\Middleware\AuthenticatesWithToken;

class AppsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(AuthenticatesWithToken::class);
    }

    /**
     * Get an app by ID.
     *
     * @param  \Soketi\EchoServer\Contracts\AppsManager  $appsManager
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(AppsManager $appsManager, Request $request)
    {
        if ($request->appId) {
            $app = $appsManager->findById($request->appId);
        } elseif ($request->appKey) {
            $app = $appsManager->findByKey($request->appKey);
        } else {
            $app = null;
        }

        if (! $app) {
            return response()->json(['app' => null], 404);
        }

        return response()->json([
            'app' => $app->toArray(),
        ]);
    }
}
