<?php

namespace HelgeSverre\Podscan\Resource;

use HelgeSverre\Podscan\Requests\Podcasts\PodcastsEpisodesIndex;
use HelgeSverre\Podscan\Requests\Podcasts\PodcastsSearch;
use HelgeSverre\Podscan\Requests\Podcasts\PodcastsShow;
use HelgeSverre\Podscan\Requests\Podcasts\PodcastsSuggest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Podcasts extends BaseResource
{
    public function suggest(string $url): Response
    {
        return $this->connector->send(new PodcastsSuggest($url));
    }

    public function search(
        ?string $query = null,
        ?int $perPage = null,
        ?string $orderBy = null,
        ?string $orderDir = null,
    ): Response {
        return $this->connector->send(new PodcastsSearch(
            q: $query,
            perPage: $perPage,
            orderBy: $orderBy,
            orderDir: $orderDir,
        ));
    }

    /**
     * @param  string  $podcast  The ID of the podcast
     */
    public function get(string $podcast): Response
    {
        return $this->connector->send(new PodcastsShow($podcast));
    }

    /**
     * @param  string  $podcast  The ID of the podcast
     */
    public function episodes(string $podcast): Response
    {
        return $this->connector->send(new PodcastsEpisodesIndex($podcast));
    }
}
