<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Sentry\Integration;

use Extly\Sentry\Event;
use Extly\Sentry\EventHint;
use Extly\Sentry\SentrySdk;
use Extly\Sentry\State\Scope;

/**
 * This integration sets the `transaction` attribute of the event to the value
 * found in the raw event payload or to the value of the `PATH_INFO` server var
 * if present.
 *
 * @author Stefano Arlandini <sarlandini@alice.it>
 */
final class TransactionIntegration implements IntegrationInterface
{
    /**
     * {@inheritdoc}
     */
    public function setupOnce(): void
    {
        Scope::addGlobalEventProcessor(static function (Event $event, EventHint $hint): Event {
            $integration = SentrySdk::getCurrentHub()->getIntegration(self::class);

            // The client bound to the current hub, if any, could not have this
            // integration enabled. If this is the case, bail out
            if (null === $integration) {
                return $event;
            }

            if (null !== $event->getTransaction()) {
                return $event;
            }

            if (isset($hint->extra['transaction'])) {
                $event->setTransaction($hint->extra['transaction']);
            } elseif (isset($_SERVER['PATH_INFO'])) {
                $event->setTransaction($_SERVER['PATH_INFO']);
            }

            return $event;
        });
    }
}
