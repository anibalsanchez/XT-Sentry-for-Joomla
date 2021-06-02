<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Sentry\Integration;

use Extly\Sentry\Event;
use Extly\Sentry\ExceptionMechanism;
use Extly\Sentry\State\HubInterface;
use Extly\Sentry\State\Scope;

abstract class AbstractErrorListenerIntegration implements IntegrationInterface
{
    /**
     * Captures the exception using the given hub instance.
     *
     * @param HubInterface $hub       The hub instance
     * @param \Throwable   $exception The exception instance
     */
    protected function captureException(HubInterface $hub, \Throwable $exception): void
    {
        $hub->withScope(function (Scope $scope) use ($hub, $exception): void {
            $scope->addEventProcessor(\Closure::fromCallable([$this, 'addExceptionMechanismToEvent']));

            $hub->captureException($exception);
        });
    }

    /**
     * Adds the exception mechanism to the event.
     *
     * @param Event $event The event object
     */
    protected function addExceptionMechanismToEvent(Event $event): Event
    {
        $exceptions = $event->getExceptions();

        foreach ($exceptions as $exception) {
            $exception->setMechanism(new ExceptionMechanism(ExceptionMechanism::TYPE_GENERIC, false));
        }

        return $event;
    }
}
