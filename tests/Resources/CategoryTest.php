<?php

// Generated 2024-03-23 11:10:40

use HelgeSverre\Podscan\Requests\Category\CategoriesIndex;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

beforeEach(function () {
    $this->podscan = new HelgeSverre\Podscan\Podscan(
        apiKey: config('podscan.api_key')
    );
});

it('calls the list method in the Category resource', function () {
    Saloon::fake([
        CategoriesIndex::class => MockResponse::fixture('category.categoriesIndex'),
    ]);

    $response = $this->podscan->category()->list();

    Saloon::assertSent(CategoriesIndex::class);

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->json())->toHaveKey('categories')
        ->and($response->json('categories.0'))->toHaveKeys([
            'category_id',
            'category_name',
            'category_display_name',
        ]);
});
