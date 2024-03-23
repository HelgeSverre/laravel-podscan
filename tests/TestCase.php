<?php

namespace HelgeSverre\Podscan\Tests;

use Dotenv\Dotenv;
use HelgeSverre\Podscan\PodscanServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Saloon\Laravel\SaloonServiceProvider;
use Spatie\LaravelData\LaravelDataServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            SaloonServiceProvider::class,
            PodscanServiceProvider::class,
            LaravelDataServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // Load .env.test into the environment.
        if (file_exists(dirname(__DIR__).'/.env')) {
            (Dotenv::createImmutable(dirname(__DIR__), '.env'))->load();
        }

        config()->set('podscan.api_key', env('PODSCAN_API_KEY'));
    }
}
