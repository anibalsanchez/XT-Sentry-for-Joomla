<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Sentry\Serializer;

use Extly\Sentry\Event;

/**
 * This interface defines the contract for the classes willing to serialize an
 * event object to a format suitable for sending over the wire to Sentry.
 */
interface PayloadSerializerInterface
{
    /**
     * Serializes the given event object into a string.
     *
     * @param Event $event The event object
     */
    public function serialize(Event $event): string;
}
