<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Http\Client\Common\Plugin;

use Extly\Http\Message\Stream\BufferedStream;
use Extly\Http\Promise\Promise;
use Extly\Psr\Http\Message\RequestInterface;
use Extly\Psr\Http\Message\ResponseInterface;

/**
 * Allow body used in response to be always seekable.
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 */
final class ResponseSeekableBodyPlugin extends SeekableBodyPlugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response) {
            if ($response->getBody()->isSeekable()) {
                return $response;
            }

            return $response->withBody(new BufferedStream($response->getBody(), $this->useFileBuffer, $this->memoryBufferSize));
        });
    }
}
