<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\Symfony\Component\HttpClient\Exception;

use Extly\Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;

/**
 * Represents a 4xx response.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
final class ClientException extends \RuntimeException implements ClientExceptionInterface
{
    use HttpExceptionTrait;
}