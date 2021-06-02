<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Sentry\Transport;

use Extly\Sentry\Options;

/**
 * This interface defines a contract for all classes willing to create instances
 * of the transport to use with the Sentry client.
 */
interface TransportFactoryInterface
{
    /**
     * Creates a new instance of a transport that will be used to send events.
     *
     * @param Options $options The options of the Sentry client
     */
    public function create(Options $options): TransportInterface;
}
