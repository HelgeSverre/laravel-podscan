<?php

namespace HelgeSverre\Podscan\Requests\Teams;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * teams.index
 *
 * Returns all the teams that the API key can access
 */
class TeamsIndex extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/teams';
    }

    public function __construct()
    {
    }
}
