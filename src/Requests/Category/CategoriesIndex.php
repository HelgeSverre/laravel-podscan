<?php

namespace HelgeSverre\Podscan\Requests\Category;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * categories.index
 */
class CategoriesIndex extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/categories';
    }

    public function __construct()
    {
    }
}
