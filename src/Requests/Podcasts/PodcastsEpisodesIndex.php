<?php

namespace HelgeSverre\Podscan\Requests\Podcasts;

use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasRequestPagination;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\PaginationPlugin\PagedPaginator;
use Saloon\PaginationPlugin\Paginator;

/**
 * podcasts.episodes.index
 */
class PodcastsEpisodesIndex extends Request implements HasRequestPagination, Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/podcasts/{$this->podcast}/episodes";
    }

    /**
     * @param  string  $podcast  The ID of the podcast
     */
    public function __construct(
        protected string $podcast,
    ) {
    }

    public function paginate(Connector $connector): Paginator
    {
        return new class(connector: $connector, request: $this) extends PagedPaginator
        {
            protected function isLastPage(Response $response): bool
            {
                return $response->json('current_page') == $response->json('last_page');
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->json('episodes');
            }
        };
    }
}
