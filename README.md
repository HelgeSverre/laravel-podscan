<p align="center"><img src="./art/header.png"></p>

# Laravel Client for the Podscan.fm API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/helgesverre/laravel-podscan.svg?style=flat-square)](https://packagist.org/packages/helgesverre/laravel-podscan)
[![Total Downloads](https://img.shields.io/packagist/dt/helgesverre/laravel-podscan.svg?style=flat-square)](https://packagist.org/packages/helgesverre/laravel-podscan)

This package provides a simple and easy-to-use API client for the Podscan.fm API

## Installation

You can install the package via composer:

```bash
composer require helgesverre/laravel-podscan
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="podscan-config"
```

This is the contents of the published config file:

```php
return [
    'api_key' => env('PODSCAN_API_KEY'),
];
```

## Usage

### Client Instantiation

Create an instance of the Podscan client to start interacting with the API. This instance will be your primary interface
for sending requests to Podscan.AI.

```php
use HelgeSverre\Podscan\Podscan;

// Instantiate the client
$podscan = new Podscan(apiKey: config('podscan.api_key'));

// Or use the Facade (Laravel)
Podscan::alerts();
Podscan::category();
Podscan::episodes();
Podscan::podcasts();
Podscan::teams();
```

## Resources

### Alerts

```php
Podscan::alerts()->list();
Podscan::alerts()->create();
Podscan::alerts()->get();
Podscan::alerts()->update();
Podscan::alerts()->delete();
Podscan::alerts()->mentions();
Podscan::alerts()->mention();
```

### Categories

```php  
Podscan::categories()->list();
```

### Episodes

```php
Podscan::episodes()->search();
Podscan::episodes()->paginatedSearch();
Podscan::episodes()->recent();
Podscan::episodes()->get();
```

### Podcasts

```php
Podscan::podcasts()->suggest();
Podscan::podcasts()->search();
Podscan::podcasts()->paginatedSearch();
Podscan::podcasts()->get();
Podscan::podcasts()->episodes();
Podscan::podcasts()->paginatedEpisodes();
```

### Teams

```php
Podscan::teams()->list();
```

## Testing

```bash
cp .env.example .env
composer test
composer analyse src
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Disclaimer

[Podscan](https://podscan.fm/) and the Podscan logo are trademarks of [Arvid Kahl](https://twitter.com/arvidkahl). This
package is not
affiliated with Podscan or Arvid Kahl in any way.
