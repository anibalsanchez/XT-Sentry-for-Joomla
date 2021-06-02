<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Sentry\HttpClient;

use Extly\Http\Client\HttpAsyncClient as HttpAsyncClientInterface;
use Extly\Sentry\Options;

/**
 * This interface defines a contract for classes willing to serve as factories
 * for the HTTP client.
 */
interface HttpClientFactoryInterface
{
    /**
     * Create HTTP Client wrapped with configured plugins.
     *
     * @param Options $options The client options
     */
    public function create(Options $options): HttpAsyncClientInterface;
}
