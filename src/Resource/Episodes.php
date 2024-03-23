<?php

namespace HelgeSverre\Podscan\Resource;

use DateTime;
use HelgeSverre\Podscan\Requests\Episodes\EpisodesRecent;
use HelgeSverre\Podscan\Requests\Episodes\EpisodesSearch;
use HelgeSverre\Podscan\Requests\Episodes\EpisodesShow;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Episodes extends BaseResource
{
    public function search(
        ?string $query = null,
        ?int $perPage = null,
        ?string $orderBy = null,
        ?string $orderDir = null,
    ): Response {
        return $this->connector->send(new EpisodesSearch(
            q: $query,
            perPage: $perPage,
            orderBy: $orderBy,
            orderDir: $orderDir,
        ));
    }

    // limit is the number of episodes to return
    //before is the date to get episodes before
    //since is the date to get episodes since
    public function recent(
        ?int $limit = null,
        ?DateTime $before = null,
        ?DateTime $since = null,
    ): Response {
        return $this->connector->send(new EpisodesRecent(
            limit: $limit,
            before: $before,
            since: $since,
        ));
    }

    /**
     * @param  string  $episode  The ID of the episode
     */
    public function get(string $episode): Response
    {
        return $this->connector->send(new EpisodesShow($episode));
    }
}
