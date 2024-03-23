<?php

namespace HelgeSverre\Podscan\Requests\Alerts;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * alerts.mentions.show
 *
 * Returns the details of a single mention.
 */
class AlertsMentionsShow extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/teams/{$this->team}/alerts/{$this->alert}/mentions/{$this->mention}";
    }

    /**
     * @param  string  $team  The ID of the team as a string
     * @param  string  $alert  The ID of the alert as a string
     * @param  string  $mention  The ID of the mention as a string
     */
    public function __construct(
        protected string $team,
        protected string $alert,
        protected string $mention,
    ) {
    }
}
