<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Http\Client\Common\Plugin;

use Extly\Http\Client\Common\Plugin;
use Extly\Http\Promise\Promise;
use Extly\Psr\Http\Message\RequestInterface;

/**
 * Append headers to the request.
 *
 * If the header already exists the value will be appended to the current value.
 *
 * This only makes sense for headers that can have multiple values like 'Forwarded'
 *
 * @see https://en.wikipedia.org/wiki/List_of_HTTP_header_fields
 *
 * @author Soufiane Ghzal <sghzal@gmail.com>
 */
final class HeaderAppendPlugin implements Plugin
{
    /**
     * @var array
     */
    private $headers;

    /**
     * @param array $headers Hashmap of header name to header value
     */
    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        foreach ($this->headers as $header => $headerValue) {
            $request = $request->withAddedHeader($header, $headerValue);
        }

        return $next($request);
    }
}
