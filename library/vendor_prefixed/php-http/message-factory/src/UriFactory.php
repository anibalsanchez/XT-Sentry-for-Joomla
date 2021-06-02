<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Message;

use Psr\Http\Message\UriInterface;

/**
 * Factory for PSR-7 URI.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface UriFactory
{
    /**
     * Creates an PSR-7 URI.
     *
     * @param string|UriInterface $uri
     *
     * @return UriInterface
     *
     * @throws \InvalidArgumentException If the $uri argument can not be converted into a valid URI.
     */
    public function createUri($uri);
}
