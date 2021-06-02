<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Jean85\Exception;

class ReplacedPackageException extends \Exception implements VersionMissingExceptionInterface
{
    public static function create(string $packageName): VersionMissingExceptionInterface
    {
        return new self('Cannot retrieve a version for package ' . $packageName . ' since it is replaced by some other package');
    }
}
