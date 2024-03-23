<?php

// Generated 2024-03-23 11:10:40

use HelgeSverre\Podscan\Requests\Teams\TeamsIndex;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

beforeEach(function () {
    $this->podscan = new HelgeSverre\Podscan\Podscan(
        apiKey: config('podscan.api_key')
    );
});

it('calls the teamsIndex method in the Teams resource', function () {
    Saloon::fake([
        TeamsIndex::class => MockResponse::fixture('teams.teamsIndex'),
    ]);

    $response = $this->podscan->teams()->list();

    Saloon::assertSent(TeamsIndex::class);

    expect($response->status())->toBe(200)
        ->and($response->json('teams'))->toBeArray()
        ->and($response->json('teams.0'))->toBeArray()
        ->and($response->json('teams.0.team_id'))->toEqual('te_o3l9ngj8y2z4wa2m');
});
