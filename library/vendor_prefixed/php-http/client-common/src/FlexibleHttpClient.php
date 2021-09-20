<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Http\Client\Common;

use Extly\Http\Client\HttpAsyncClient;
use Extly\Http\Client\HttpClient;
use Extly\Psr\Http\Client\ClientInterface;

/**
 * A flexible http client, which implements both interface and will emulate
 * one contract, the other, or none at all depending on the injected client contract.
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 */
final class FlexibleHttpClient implements HttpClient, HttpAsyncClient
{
    use HttpClientDecorator;
    use HttpAsyncClientDecorator;

    /**
     * @param ClientInterface|HttpAsyncClient $client
     */
    public function __construct($client)
    {
        if (!$client instanceof ClientInterface && !$client instanceof HttpAsyncClient) {
            throw new \TypeError(
                sprintf('%s::__construct(): Argument #1 ($client) must be of type %s|%s, %s given', self::class, ClientInterface::class, HttpAsyncClient::class, get_debug_type($client))
            );
        }

        $this->httpClient = $client instanceof ClientInterface ? $client : new EmulatedHttpClient($client);
        $this->httpAsyncClient = $client instanceof HttpAsyncClient ? $client : new EmulatedHttpAsyncClient($client);
    }
}
