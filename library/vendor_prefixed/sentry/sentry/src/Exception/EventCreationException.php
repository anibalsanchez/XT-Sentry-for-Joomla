<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Sentry\Exception;

/**
 * This exception is thrown when an issue is preventing the creation of an {@see Event}.
 */
class EventCreationException extends \RuntimeException implements ExceptionInterface
{
    /**
     * EventCreationException constructor.
     *
     * @param \Throwable $previous The original error that was thrown while
     *                             instantiating an {@see Event}
     */
    public function __construct(\Throwable $previous)
    {
        parent::__construct('Unable to instantiate an event', 0, $previous);
    }
}
