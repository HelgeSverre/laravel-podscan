<?php

// Generated 2024-03-23 11:10:40

use HelgeSverre\Podscan\Requests\Podcasts\PodcastsEpisodesIndex;
use HelgeSverre\Podscan\Requests\Podcasts\PodcastsSearch;
use HelgeSverre\Podscan\Requests\Podcasts\PodcastsShow;
use HelgeSverre\Podscan\Requests\Podcasts\PodcastsSuggest;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

beforeEach(function () {
    $this->podscan = new HelgeSverre\Podscan\Podscan(
        apiKey: config('podscan.api_key')
    );
});

it('calls the podcastsSuggest method in the Podcasts resource', function () {
    Saloon::fake([
        PodcastsSuggest::class => MockResponse::fixture('podcasts.podcastsSuggest'),
    ]);

    $response = $this->podscan->podcasts()->suggest(
        url: 'https://feeds.transistor.fm/no-compromises'
    );

    Saloon::assertSent(PodcastsSuggest::class);

    expect($response->status())->toBe(200)
        ->and($response->json('queued'))->toBeTrue();

});

it('calls the search method in the Podcasts resource', function () {
    Saloon::fake([
        PodcastsSearch::class => MockResponse::fixture('podcasts.podcastsSearch'),
    ]);

    $response = $this->podscan->podcasts()->search(
        query: '"the bootstrapped founder"',
        perPage: 10,
        orderBy: 'episode_count',
        orderDir: 'asc'
    );

    Saloon::assertSent(PodcastsSearch::class);

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->json())->toHaveKeys([
            'podcasts',
            'pagination',
        ])
        ->and($response->json('podcasts.0'))->toHaveKeys([
            'podcast_id',
            'podcast_guid',
            'podcast_name',
            'podcast_url',
            'rss_url',
            'episode_count',
            'last_posted_at',
            'last_scanned_at',
            'created_at',
            'updated_at',
        ]);
});

it('calls the podcastsShow method in the Podcasts resource', function () {
    Saloon::fake([
        PodcastsShow::class => MockResponse::fixture('podcasts.podcastsShow'),
    ]);

    $response = $this->podscan->podcasts()->get(
        podcast: 'pd_dpmk29neka9ev8nz' // "The Bootstrapped Founder"
    );

    Saloon::assertSent(PodcastsShow::class);

    expect($response->status())->toBe(200)
        ->and($response->json('podcast'))->toHaveKeys([
            'podcast_id',
            'podcast_guid',
            'podcast_name',
            'podcast_url',
            'rss_url',
            'episode_count',
            'last_posted_at',
            'last_scanned_at',
            'created_at',
            'updated_at',
        ]);
});

it('calls the episodes method in the Podcasts resource', function () {
    Saloon::fake([
        PodcastsEpisodesIndex::class => MockResponse::fixture('podcasts.podcastsEpisodesIndex'),
    ]);

    $response = $this->podscan->podcasts()->episodes(
        podcast: 'pd_dpmk29neka9ev8nz' // "The Bootstrapped Founder"
    );

    dump($response->json());

    Saloon::assertSent(PodcastsEpisodesIndex::class);

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
        ])
        ->and($response->json('episodes.0.podcast'))->toHaveKeys([
            'podcast_id',
            'podcast_name',
            'podcast_url',
        ]);
});
