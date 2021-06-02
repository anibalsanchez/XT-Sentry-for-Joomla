<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Message\UriFactory;

use function GuzzleHttp\Psr7\uri_for;
use GuzzleHttp\Psr7\Utils;
use Extly\Http\Message\UriFactory;

/**
 * Creates Guzzle URI.
 *
 * @author David de Boer <david@ddeboer.nl>
 *
 * @deprecated This will be removed in php-http/message2.0. Consider using the official Guzzle PSR-17 factory
 */
final class GuzzleUriFactory implements UriFactory
{
    /**
     * {@inheritdoc}
     */
    public function createUri($uri)
    {
        if (class_exists(Utils::class)) {
            return Utils::uriFor($uri);
        }

        return uri_for($uri);
    }
}
