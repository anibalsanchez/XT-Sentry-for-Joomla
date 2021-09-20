<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Http\Client\Common;

use Extly\Http\Client\Exception;
use Extly\Http\Client\Promise;
use Extly\Psr\Http\Message\RequestInterface;
use Extly\Psr\Http\Message\ResponseInterface;

/**
 * Emulates an HTTP Async Client in an HTTP Client.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait HttpAsyncClientEmulator
{
    /**
     * {@inheritdoc}
     *
     * @see HttpClient::sendRequest
     */
    abstract public function sendRequest(RequestInterface $request): ResponseInterface;

    /**
     * {@inheritdoc}
     *
     * @see HttpAsyncClient::sendAsyncRequest
     */
    public function sendAsyncRequest(RequestInterface $request)
    {
        try {
            return new Promise\HttpFulfilledPromise($this->sendRequest($request));
        } catch (Exception $e) {
            return new Promise\HttpRejectedPromise($e);
        }
    }
}
