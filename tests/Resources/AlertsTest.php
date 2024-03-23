<?php

// Generated 2024-03-23 11:10:40

use HelgeSverre\Podscan\Requests\Alerts\AlertsCreate;
use HelgeSverre\Podscan\Requests\Alerts\AlertsDelete;
use HelgeSverre\Podscan\Requests\Alerts\AlertsIndex;
use HelgeSverre\Podscan\Requests\Alerts\AlertsMentionsIndex;
use HelgeSverre\Podscan\Requests\Alerts\AlertsMentionsShow;
use HelgeSverre\Podscan\Requests\Alerts\AlertsShow;
use HelgeSverre\Podscan\Requests\Alerts\AlertsUpdate;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

beforeEach(function () {
    $this->podscan = new HelgeSverre\Podscan\Podscan(
        apiKey: config('podscan.api_key')
    );
});

it('calls the list method in the Alerts resource', function () {
    Saloon::fake([
        AlertsIndex::class => MockResponse::fixture('alerts.list'),
    ]);

    $response = $this->podscan->alerts()->list(
        team: 'te_o3l9ngj8y2z4wa2m',
    );

    Saloon::assertSent(AlertsIndex::class);

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->json())->toHaveKeys([
            'alerts',
            'pagination',
        ]);
});

it('calls the create method in the Alerts resource', function () {
    Saloon::fake([
        AlertsCreate::class => MockResponse::fixture('alerts.create'),
    ]);

    $response = $this->podscan->alerts()->create(
        team: 'te_o3l9ngj8y2z4wa2m',
        alertName: 'My own name',
        promptFilters: [
            '"helge sverre"',
        ],
        alertEnabled: true,
        restrictToPodcastIds: ['pd_dpmk29neka9ev8nz']
    );

    Saloon::assertSent(AlertsCreate::class);

    expect($response->status())->toBe(200)
        ->and($response->json('status'))->toEqual('created')
        ->and($response->json('alert'))->toBeArray()
        ->and($response->json('alert'))->toEqual([
            'alert_id' => 'al_k432x7glbz9jvbmp',
            'alert_enabled' => true,
            'alert_name' => 'My own name',
            'created_at' => '2024-03-23T13:11:45+00:00',
            'updated_at' => '2024-03-23T13:11:45+00:00',
            'prompt_filters' => ['"helge sverre"'],
            'prompt_question' => null,
            'prompt_question_enabled' => false,
            'webhook_enabled' => false,
            'webhook_url' => null,
            'notification_email' => null,
            'notification_summary_enabled' => false,
            'notification_summary_frequency' => 'daily',
            'restrict_to_category_ids' => null,
            'restrict_to_podcast_ids' => 'pd_dpmk29neka9ev8nz',
            'mention_count' => 0,
            'team_id' => 'te_o3l9ngj8y2z4wa2m',
        ]);
});

it('calls the get method in the Alerts resource', function () {
    Saloon::fake([
        AlertsShow::class => MockResponse::fixture('alerts.get'),
    ]);

    $response = $this->podscan->alerts()->get(
        team: 'te_o3l9ngj8y2z4wa2m',
        alert: 'al_k432x7glbz9jvbmp'
    );

    Saloon::assertSent(AlertsShow::class);

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->json())->toHaveKeys([
            'alert',
        ])
        ->and($response->json('alert'))->toHaveKeys([
            'alert_id',
            'alert_name',
            'prompt_filters',
            'alert_enabled',
            'notification_email',
            'notification_summary_enabled',
            'notification_summary_frequency',
            'webhook_enabled',
            'webhook_url',
            'prompt_question_enabled',
            'prompt_question',
            'restrict_to_category_ids',
            'restrict_to_podcast_ids',
            'mention_count',
            'team_id',
            'created_at',
            'updated_at',
        ]);
});

it('calls the update method in the Alerts resource', function () {
    Saloon::fake([
        AlertsUpdate::class => MockResponse::fixture('alerts.update'),
    ]);

    $response = $this->podscan->alerts()->update(
        team: 'te_o3l9ngj8y2z4wa2m',
        alert: 'al_k432x7glbz9jvbmp',
        alertName: 'My own name 2',
        promptFilters: [
            '"helge sverre"',
        ],
    );

    Saloon::assertSent(AlertsUpdate::class);

    expect($response->status())->toBe(200)
        ->and($response->json('status'))->toEqual('updated')
        ->and($response->json('alert'))->toBeArray();
});

it('calls the delete method in the Alerts resource', function () {
    Saloon::fake([
        AlertsDelete::class => MockResponse::fixture('alerts.delete'),
    ]);

    $response = $this->podscan->alerts()->delete(
        team: 'te_o3l9ngj8y2z4wa2m',
        alert: 'al_k432x7glbz9jvbmp'
    );

    Saloon::assertSent(AlertsDelete::class);

    expect($response->status())->toBe(200)
        ->and($response->json('status'))->toEqual('deleted');
});

it('calls the mentions method in the Alerts resource', function () {
    Saloon::fake([
        AlertsMentionsIndex::class => MockResponse::fixture('alerts.mentions'),
    ]);

    $response = $this->podscan->alerts()->mentions(
        team: 'te_o3l9ngj8y2z4wa2m',
        alert: 'al_k432x7glbz9jvbmp'
    );

    Saloon::assertSent(AlertsMentionsIndex::class);

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->json())->toHaveKeys([
            'mentions',
            'alert',
            'pagination',
        ]);
});

it('calls the mention method in the Alerts resource', function () {
    Saloon::fake([
        AlertsMentionsShow::class => MockResponse::fixture('alerts.mention'),
    ]);

    $response = $this->podscan->alerts()->mention(
        team: 'te_o3l9ngj8y2z4wa2m',
        alert: 'al_k432x7glbz9jvbmp',
        mention: 'invalid'
    );

    Saloon::assertSent(AlertsMentionsShow::class);

    expect($response->status())->toBe(406)
        ->and($response->json('error'))->toEqual('Invalid mention id');
});
