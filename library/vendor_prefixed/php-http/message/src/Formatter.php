<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Message;

use Extly\Psr\Http\Message\RequestInterface;
use Extly\Psr\Http\Message\ResponseInterface;

/**
 * Formats a request and/or a response as a string.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Formatter
{
    /**
     * Formats a request.
     *
     * @return string
     */
    public function formatRequest(RequestInterface $request);

    /**
     * Formats a response.
     *
     * @return string
     */
    public function formatResponse(ResponseInterface $response);
}
