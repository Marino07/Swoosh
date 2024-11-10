<?php

use Illuminate\Broadcasting\BroadcastServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    App\Providers\VoltServiceProvider::class,
    BroadcastServiceProvider::class,
    App\Providers\BroadcastServiceProvider::class,
];
