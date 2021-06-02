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

namespace Extly\Symfony\Component\HttpClient\Internal;

/**
 * Internal representation of the client state.
 *
 * @author Alexander M. Turek <me@derrabus.de>
 *
 * @internal
 */
class ClientState
{
    public $handlesActivity = [];
    public $openHandles = [];
}
