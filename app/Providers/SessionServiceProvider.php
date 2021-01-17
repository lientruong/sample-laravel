<?php

namespace App\Providers;

use App\Handlers\DatabaseSessionHandler;
use Illuminate\Contracts\Cache\Factory as CacheFactory;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends  ServiceProvider {


    public function boot() {
        Session::extend('app-database', function($app) {
            $table   = Config::get('session.table');
            $minutes = Config::get('session.lifetime');
            $connection = $app->app->db->connection($this->app->config->get('session.connection'));
            return new DatabaseSessionHandler($connection, $table, $minutes, $this->app);
        });
    }
}