<?php

namespace HelgeSverre\Podscan\Requests\Episodes;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * episodes.search
 *
 * Full-text search for episodes
 *
 * Use these query parameters to filter the results:
 *  - `query` is the
 * search query
 *  - `per_page` is the number of results per page
 *  - `order_by` is the field to order by
 *
 * - `order_dir` is the direction to order
 *
 * Inside the query, use `*` as a wildcard for any character
 * sequence, and `"` to search for an exact phrase.
 */
class EpisodesSearch extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/episodes/search';
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'query' => $this->q,
            'per_page' => $this->perPage,
            'order_by' => $this->orderBy,
            'order_dir' => $this->orderDir,
        ]);
    }

    public function __construct(
        protected ?string $q = null,
        protected ?int $perPage = null,
        protected ?string $orderBy = null,
        protected ?string $orderDir = null,
    ) {
    }
}