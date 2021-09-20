<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Http\Client\Common;

use Extly\Http\Client\Exception;
use Extly\Http\Client\HttpClient;
use Extly\Psr\Http\Message\ResponseInterface;
use Extly\Psr\Http\Message\StreamInterface;
use Extly\Psr\Http\Message\UriInterface;

/**
 * Convenience HTTP client that integrates the MessageFactory in order to send
 * requests in the following form:.
 *
 * $client
 *     ->get('/foo')
 *     ->post('/bar')
 * ;
 *
 * The client also exposes the sendRequest methods of the wrapped HttpClient.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 * @author David Buchmann <mail@davidbu.ch>
 */
interface HttpMethodsClientInterface extends HttpClient
{
    /**
     * Sends a GET request.
     *
     * @param string|UriInterface $uri
     *
     * @throws Exception
     */
    public function get($uri, array $headers = []): ResponseInterface;

    /**
     * Sends an HEAD request.
     *
     * @param string|UriInterface $uri
     *
     * @throws Exception
     */
    public function head($uri, array $headers = []): ResponseInterface;

    /**
     * Sends a TRACE request.
     *
     * @param string|UriInterface $uri
     *
     * @throws Exception
     */
    public function trace($uri, array $headers = []): ResponseInterface;

    /**
     * Sends a POST request.
     *
     * @param string|UriInterface         $uri
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     */
    public function post($uri, array $headers = [], $body = null): ResponseInterface;

    /**
     * Sends a PUT request.
     *
     * @param string|UriInterface         $uri
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     */
    public function put($uri, array $headers = [], $body = null): ResponseInterface;

    /**
     * Sends a PATCH request.
     *
     * @param string|UriInterface         $uri
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     */
    public function patch($uri, array $headers = [], $body = null): ResponseInterface;

    /**
     * Sends a DELETE request.
     *
     * @param string|UriInterface         $uri
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     */
    public function delete($uri, array $headers = [], $body = null): ResponseInterface;

    /**
     * Sends an OPTIONS request.
     *
     * @param string|UriInterface         $uri
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     */
    public function options($uri, array $headers = [], $body = null): ResponseInterface;

    /**
     * Sends a request with any HTTP method.
     *
     * @param string                      $method HTTP method to use
     * @param string|UriInterface         $uri
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     */
    public function send(string $method, $uri, array $headers = [], $body = null): ResponseInterface;
}
