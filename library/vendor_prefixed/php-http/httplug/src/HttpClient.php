<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Client;

use Extly\Psr\Http\Client\ClientInterface;

/**
 * {@inheritdoc}
 *
 * Provide the Httplug HttpClient interface for BC.
 * You should typehint Psr\Http\Client\ClientInterface in new code
 */
interface HttpClient extends ClientInterface
{
}
