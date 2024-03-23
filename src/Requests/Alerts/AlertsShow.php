<?php

namespace HelgeSverre\Podscan\Requests\Alerts;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * alerts.show
 *
 * Returns the details of a single alert.
 */
class AlertsShow extends Request
{
    protected Method $method = Method::GET;

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
