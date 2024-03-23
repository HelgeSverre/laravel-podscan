<?php

namespace HelgeSverre\Podscan\Requests\Episodes;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * episodes.recent
 *
 * List the most recently ingested & transcribed episodes.
 *
 * Use these query parameters to filter the
 * results:
 *  - `limit` is the number of episodes to return
 *  - `before` is the date to get episodes before
 *  - `since` is the date to get episodes since
 */
class EpisodesRecent extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/episodes/recent';
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'limit' => $this->limit,
            'before' => $this->before?->format(DateTime::ATOM),
            'since' => $this->since?->format(DateTime::ATOM),
        ]);

    }

    public function __construct(
        protected ?int $limit = null,
        protected ?DateTime $before = null,
        protected ?DateTime $since = null,
    ) {
    }
}
