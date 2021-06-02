<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Sentry\Transport;

use Extly\GuzzleHttp\Promise\FulfilledPromise;
use Extly\GuzzleHttp\Promise\PromiseInterface;
use Extly\Sentry\Event;
use Extly\Sentry\Response;
use Extly\Sentry\ResponseStatus;

/**
 * This transport fakes the sending of events by just ignoring them.
 *
 * @author Stefano Arlandini <sarlandini@alice.it>
 */
final class NullTransport implements TransportInterface
{
    /**
     * {@inheritdoc}
     */
    public function send(Event $event): PromiseInterface
    {
        return new FulfilledPromise(new Response(ResponseStatus::skipped(), $event));
    }

    /**
     * {@inheritdoc}
     */
    public function close(?int $timeout = null): PromiseInterface
    {
        return new FulfilledPromise(true);
    }
}
