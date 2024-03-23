<?php

namespace HelgeSverre\Podscan\Requests\Episodes;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * episodes.show
 */
class EpisodesShow extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/episodes/{$this->episode}";
    }

    /**
     * @param  string  $episode  The ID of the episode
     */
    public function __construct(
        protected string $episode,
    ) {
    }
}
