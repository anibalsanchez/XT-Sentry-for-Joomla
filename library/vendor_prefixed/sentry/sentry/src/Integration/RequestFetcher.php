<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Sentry\Integration;

use Extly\GuzzleHttp\Psr7\ServerRequest;
use Extly\Psr\Http\Message\ServerRequestInterface;

/**
 * Default implementation for RequestFetcherInterface. Creates a request object
 * from the PHP superglobals.
 */
final class RequestFetcher implements RequestFetcherInterface
{
    /**
     * {@inheritdoc}
     */
    public function fetchRequest(): ?ServerRequestInterface
    {
        if (!isset($_SERVER['REQUEST_METHOD']) || \PHP_SAPI === 'cli') {
            return null;
        }

        return ServerRequest::fromGlobals();
    }
}
