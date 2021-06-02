<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Http\Client\Common\Plugin;

use Extly\Http\Client\Common\Plugin;
use Extly\Http\Message\Encoding\ChunkStream;
use Extly\Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

/**
 * Allow to set the correct content length header on the request or to transfer it as a chunk if not possible.
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 */
final class ContentLengthPlugin implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        if (!$request->hasHeader('Content-Length')) {
            $stream = $request->getBody();

            // Cannot determine the size so we use a chunk stream
            if (null === $stream->getSize()) {
                $stream = new ChunkStream($stream);
                $request = $request->withBody($stream);
                $request = $request->withAddedHeader('Transfer-Encoding', 'chunked');
            } else {
                $request = $request->withHeader('Content-Length', (string) $stream->getSize());
            }
        }

        return $next($request);
    }
}
