<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Sentry\Integration;

use Extly\Sentry\Context\OsContext;
use Extly\Sentry\Context\RuntimeContext;
use Extly\Sentry\Event;
use Extly\Sentry\SentrySdk;
use Extly\Sentry\State\Scope;
use Extly\Sentry\Util\PHPVersion;

/**
 * This integration fills the event data with runtime and server OS information.
 *
 * @author Stefano Arlandini <sarlandini@alice.it>
 */
final class EnvironmentIntegration implements IntegrationInterface
{
    /**
     * {@inheritdoc}
     */
    public function setupOnce(): void
    {
        Scope::addGlobalEventProcessor(static function (Event $event): Event {
            $integration = SentrySdk::getCurrentHub()->getIntegration(self::class);

            if (null !== $integration) {
                $event->setRuntimeContext($integration->updateRuntimeContext($event->getRuntimeContext()));
                $event->setOsContext($integration->updateServerOsContext($event->getOsContext()));
            }

            return $event;
        });
    }

    private function updateRuntimeContext(?RuntimeContext $runtimeContext): RuntimeContext
    {
        if (null === $runtimeContext) {
            $runtimeContext = new RuntimeContext('php');
        }

        if (null === $runtimeContext->getVersion()) {
            $runtimeContext->setVersion(PHPVersion::parseVersion());
        }

        return $runtimeContext;
    }

    private function updateServerOsContext(?OsContext $osContext): OsContext
    {
        if (null === $osContext) {
            $osContext = new OsContext(php_uname('s'));
        }

        if (null === $osContext->getVersion()) {
            $osContext->setVersion(php_uname('r'));
        }

        if (null === $osContext->getBuild()) {
            $osContext->setBuild(php_uname('v'));
        }

        if (null === $osContext->getKernelVersion()) {
            $osContext->setKernelVersion(php_uname('a'));
        }

        return $osContext;
    }
}
