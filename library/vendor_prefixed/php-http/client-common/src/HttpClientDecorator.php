<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Http\Client\Common;

use Extly\Psr\Http\Client\ClientInterface;
use Extly\Psr\Http\Message\RequestInterface;
use Extly\Psr\Http\Message\ResponseInterface;

/**
 * Decorates an HTTP Client.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait HttpClientDecorator
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * {@inheritdoc}
     *
     * @see ClientInterface::sendRequest
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->httpClient->sendRequest($request);
    }
}
