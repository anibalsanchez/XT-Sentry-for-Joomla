<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Http\Client\Common\Plugin;

use Extly\Http\Client\Common\Plugin;
use Extly\Http\Promise\Promise;
use Extly\Psr\Http\Message\RequestInterface;

/**
 * Set query to default value if it does not exist.
 *
 * If a given query parameter already exists the value wont be replaced and the request wont be changed.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class QueryDefaultsPlugin implements Plugin
{
    /**
     * @var array
     */
    private $queryParams = [];

    /**
     * @param array $queryParams Hashmap of query name to query value. Names and values must not be url encoded as
     *                           this plugin will encode them
     */
    public function __construct(array $queryParams)
    {
        $this->queryParams = $queryParams;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $uri = $request->getUri();

        parse_str($uri->getQuery(), $query);
        $query += $this->queryParams;

        $request = $request->withUri(
            $uri->withQuery(http_build_query($query))
        );

        return $next($request);
    }
}
