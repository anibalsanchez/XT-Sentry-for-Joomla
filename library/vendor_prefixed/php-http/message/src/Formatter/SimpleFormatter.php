<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Message\Formatter;

use Extly\Http\Message\Formatter;
use Extly\Psr\Http\Message\RequestInterface;
use Extly\Psr\Http\Message\ResponseInterface;

/**
 * Normalize a request or a response into a string or an array.
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class SimpleFormatter implements Formatter
{
    /**
     * {@inheritdoc}
     */
    public function formatRequest(RequestInterface $request)
    {
        return sprintf(
            '%s %s %s',
            $request->getMethod(),
            $request->getUri()->__toString(),
            $request->getProtocolVersion()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function formatResponse(ResponseInterface $response)
    {
        return sprintf(
            '%s %s %s',
            $response->getStatusCode(),
            $response->getReasonPhrase(),
            $response->getProtocolVersion()
        );
    }
}
