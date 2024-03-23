<?php

namespace HelgeSverre\Podscan\Resource;

use HelgeSverre\Podscan\Requests\Teams\TeamsIndex;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Teams extends BaseResource
{
    public function list(): Response
    {
        return $this->connector->send(new TeamsIndex());
    }
}
