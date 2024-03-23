<?php

// Generated 2024-03-23 11:10:40

use HelgeSverre\Podscan\Requests\Episodes\EpisodesRecent;
use HelgeSverre\Podscan\Requests\Episodes\EpisodesSearch;
use HelgeSverre\Podscan\Requests\Episodes\EpisodesShow;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

beforeEach(function () {
    $this->podscan = new HelgeSverre\Podscan\Podscan(
        apiKey: config('podscan.api_key')
    );
});

it('calls the episodesSearch method in the Episodes resource', function () {
    Saloon::fake([
        EpisodesSearch::class => MockResponse::fixture('episodes.episodesSearch'),
    ]);

    $response = $this->podscan->episodes()->search(
        perPage: 5,
        orderBy: 'posted_at',
        orderDir: 'asc'
    );

    Saloon::assertSent(EpisodesSearch::class);

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->json())->toHaveKeys([
            'episodes',
            'pagination',
        ])
        ->and($response->json('episodes.0'))->toHaveKeys([
            'episode_id',
            'episode_guid',
            'episode_title',
            'episode_url',
            'episode_audio_url',
            'episode_duration',
            'episode_word_count',
            'created_at',
            'updated_at',
            'posted_at',
            'episode_transcript',
            'episode_description',
            'podcast',
        ]);
});

it('calls the paginatedSearch method in the Episodes resource', function () {
    Saloon::fake([
        EpisodesSearch::class => MockResponse::fixture('episodes.episodesSearch'),
    ]);

    $paginator = $this->podscan->episodes()->paginatedSearch(
        perPage: 5,
        orderBy: 'posted_at',
        orderDir: 'asc'
    );

    $paginator->current();

    Saloon::assertSent(EpisodesSearch::class);

    expect($paginator->getTotalResults())->toBe(5)
        ->and($paginator->getCurrentPage())->toBe(0)
        ->and($paginator->items())->toBeIterable()
        ->and(iterator_to_array($paginator->items())[0])->toHaveKeys([
            'episode_id',
            'episode_guid',
            'episode_title',
            'episode_url',
            'episode_audio_url',
            'episode_duration',
            'episode_word_count',
            'created_at',
            'updated_at',
            'posted_at',
            'episode_transcript',
            'episode_description',
            'podcast',
        ]);

});

it('calls the recent method in the Episodes resource', function () {
    Saloon::fake([
        EpisodesRecent::class => MockResponse::fixture('episodes.episodesRecent'),
    ]);

    $response = $this->podscan->episodes()->recent(
        limit: 2,
        before: new DateTime('2024-03-31')
    );

    Saloon::assertSent(EpisodesRecent::class);

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->json())->toHaveKeys([
            'episodes',
        ])
        ->and($response->json('episodes'))->toHaveCount(2)
        ->and($response->json('episodes.0'))->toHaveKeys([
            'episode_id',
            'episode_guid',
            'episode_title',
            'episode_url',
            'episode_audio_url',
            'episode_duration',
            'episode_word_count',
            'created_at',
            'updated_at',
            'posted_at',
            'episode_transcript',
            'episode_description',
            'podcast',
        ]);
});

it('calls the get method in the Episodes resource', function () {
    Saloon::fake([
        EpisodesShow::class => MockResponse::fixture('episodes.episodesShow'),
    ]);

    $response = $this->podscan->episodes()->get(
        episode: 'ep_nm7qj3pebqero5wd'
    );

    Saloon::assertSent(EpisodesShow::class);

    expect($response->status())->toBe(200)
        ->and($response->json('episode'))->toHaveKeys([
            'episode_id',
            'episode_guid',
            'episode_title',
            'episode_url',
            'episode_audio_url',
            'episode_duration',
            'episode_word_count',
            'created_at',
            'updated_at',
            'posted_at',
        ])
        ->and($response->json('episode.episode_title'))->toEqual('297: Payment Platforms for Solopreneurs');
});
