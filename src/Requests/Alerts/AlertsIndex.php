<?php

namespace HelgeSverre\Podscan\Requests\Alerts;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * alerts.index
 */
class AlertsIndex extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/teams/{$this->team}/alerts";
    }

    /**
     * @param  string  $team  The ID of the team as a string
     */
    public function __construct(
        protected string $team,
    ) {
    }
}
