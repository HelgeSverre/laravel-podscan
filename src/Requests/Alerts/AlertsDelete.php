<?php

namespace HelgeSverre\Podscan\Requests\Alerts;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * alerts.delete
 *
 * Deletes an alert and all its mentions.
 */
class AlertsDelete extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/teams/{$this->team}/alerts/{$this->alert}";
    }

    /**
     * @param  string  $team  The ID of the team as a string
     * @param  string  $alert  The ID of the alert as a string
     */
    public function __construct(
        protected string $team,
        protected string $alert,
    ) {
    }
}
