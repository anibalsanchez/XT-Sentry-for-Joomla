<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Sentry\Integration;

/**
 * This interface defines a contract that must be implemented by integrations,
 * bindings or hooks that integrate certain frameworks or environments with the SDK.
 */
interface IntegrationInterface
{
    /**
     * Initializes the current integration by registering it once.
     */
    public function setupOnce(): void;
}
