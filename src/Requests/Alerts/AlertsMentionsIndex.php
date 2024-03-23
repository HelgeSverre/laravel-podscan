<?php

namespace HelgeSverre\Podscan\Requests\Alerts;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * alerts.mentions.index
 *
 * Returns a list of mentions for an alert.
 */
class AlertsMentionsIndex extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/teams/{$this->team}/alerts/{$this->alert}/mentions";
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
