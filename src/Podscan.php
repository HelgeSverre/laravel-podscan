<?php

namespace HelgeSverre\Podscan;

use HelgeSverre\Podscan\Resource\Alerts;
use HelgeSverre\Podscan\Resource\Category;
use HelgeSverre\Podscan\Resource\Episodes;
use HelgeSverre\Podscan\Resource\Podcasts;
use HelgeSverre\Podscan\Resource\Teams;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use SensitiveParameter;

/**
 * Podscan.fm
 *
 *
 * The Podscan API is a RESTful API that allows you to access the Podscan platform. The API is designed to be easy to use and to have predictable, resource-oriented URLs. The API uses standard HTTP response codes and verbs, and authenticates using standard HTTP Basic Authentication.
 *
 * ## Authentication
 * The Podscan API uses standard API key authentication. You will need to provide your API key in the `Authorization` header as a `Bearer` token. You can find your [API key in the Podscan dashboard](https://podscan.fm/user/api-tokens).
 *
 * ## Rate Limiting
 * The Podscan API is rate limited. If you exceed the limit, you will receive a 429 Too Many Requests response. If we detect abuse, we will block your access to the API.
 * Here are the rate limits for the Podscan API:
 * - **Trial**: 100 requests per day, 10 requests per minute
 * - **Essential Plan**: 1000 requests per day, 60 requests per minute
 * - **Premium Plan**: 2000 requests per day, 120 requests per minute
 * - **Enterprise Plan**: 5000 requests per day, 120 requests per minute
 * - Enterprise plan owners can request custom rate limits.
 *
 * Every request to the API will return the following headers:
 * - `X-RateLimit-Limit`: The maximum number of requests that the consumer is permitted to make in a 60-minute period.
 * - `X-RateLimit-Remaining`: The number of requests remaining in the current rate limit window.
 *
 * ## Errors
 * The Podscan API uses standard HTTP response codes to indicate the success or failure of an API request. In general, codes in the 2xx range indicate success, codes in the 4xx range indicate an error that failed given the information provided (e.g., a required parameter was omitted, a charge failed, etc.), and codes in the 5xx range indicate an error with Podscan's servers.
 *
 * ## Pagination
 * Requests that return multiple items will be paginated by default. You can specify further pages with the `page` parameter. For some resources, you can also set a custom page size with the `per_page` parameter.
 *
 * ## Final Notes
 * The Podscan API is a work in progress. We will be adding more endpoints and features in the future. If you have any questions or need help, please contact us at [service@podscan.fm](mailto:service@podscan.fm).
 */
class Podscan extends Connector
{
    use AcceptsJson;

    public function __construct(
        #[SensitiveParameter]
        protected string $apiKey,
    ) {
    }

    public function resolveBaseUrl(): string
    {
        return 'https://podscan.fm/api/v1';
    }

    public function defaultAuth(): Authenticator
    {
        return new TokenAuthenticator($this->apiKey, 'Bearer');
    }

    public function alerts(): Alerts
    {
        return new Alerts($this);
    }

    public function category(): Category
    {
        return new Category($this);
    }

    public function episodes(): Episodes
    {
        return new Episodes($this);
    }

    public function podcasts(): Podcasts
    {
        return new Podcasts($this);
    }

    public function teams(): Teams
    {
        return new Teams($this);
    }
}
