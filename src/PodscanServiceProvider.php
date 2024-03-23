<?php

namespace HelgeSverre\Podscan;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PodscanServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('podscan')->hasConfigFile();
    }

    public function packageBooted(): void
    {
        $this->app->bind(Podscan::class, function () {
            return new Podscan(
                apiKey: config('podscan.api_key'),
            );
        });
    }
}
