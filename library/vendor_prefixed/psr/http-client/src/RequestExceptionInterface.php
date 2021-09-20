<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Psr\Http\Client;

use Extly\Psr\Http\Message\RequestInterface;

/**
 * Exception for when a request failed.
 *
 * Examples:
 *      - Request is invalid (e.g. method is missing)
 *      - Runtime request errors (e.g. the body stream is not seekable)
 */
interface RequestExceptionInterface extends ClientExceptionInterface
{
    /**
     * Returns the request.
     *
     * The request object MAY be a different object from the one passed to ClientInterface::sendRequest()
     *
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface;
}
