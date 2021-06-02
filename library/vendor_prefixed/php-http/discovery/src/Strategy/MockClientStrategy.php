<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Discovery\Strategy;

use Extly\Http\Client\HttpAsyncClient;
use Extly\Http\Client\HttpClient;
use Extly\Http\Mock\Client as Mock;

/**
 * Find the Mock client.
 *
 * @author Sam Rapaport <me@samrapdev.com>
 */
final class MockClientStrategy implements DiscoveryStrategy
{
    /**
     * {@inheritdoc}
     */
    public static function getCandidates($type)
    {
        if (is_a(HttpClient::class, $type, true) || is_a(HttpAsyncClient::class, $type, true)) {
            return [['class' => Mock::class, 'condition' => Mock::class]];
        }

        return [];
    }
}
