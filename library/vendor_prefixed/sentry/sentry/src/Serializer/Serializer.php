<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Sentry\Serializer;

/**
 * Basic serializer for the event data.
 */
class Serializer extends AbstractSerializer implements SerializerInterface
{
    /**
     * {@inheritdoc}
     */
    public function serialize($value)
    {
        return $this->serializeRecursively($value);
    }
}
