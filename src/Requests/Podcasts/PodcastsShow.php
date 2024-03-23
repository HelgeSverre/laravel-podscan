<?php

namespace HelgeSverre\Podscan\Requests\Podcasts;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * podcasts.show
 */
class PodcastsShow extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/podcasts/{$this->podcast}";
    }

    /**
     * @param  string  $podcast  The ID of the podcast
     */
    public function __construct(
        protected string $podcast,
    ) {
    }
}
