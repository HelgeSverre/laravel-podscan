<?php

namespace HelgeSverre\Podscan\Requests\Podcasts;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * podcasts.suggest
 *
 * Suggest a podcast to be added to the database
 *
 * Use the `url` parameter to specify the URL of the
 * podcast's RSS feed. Has to be a valid feed.
 */
class PodcastsSuggest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/podcasts/suggest';
    }

    public function __construct(
        protected string $url,
    ) {
    }

    public function defaultBody(): array
    {
        return array_filter(['url' => $this->url]);
    }
}
