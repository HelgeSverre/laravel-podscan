<?php

namespace HelgeSverre\Podscan\Resource;

use HelgeSverre\Podscan\Requests\Category\CategoriesIndex;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Category extends BaseResource
{
    public function list(): Response
    {
        return $this->connector->send(new CategoriesIndex());
    }
}
