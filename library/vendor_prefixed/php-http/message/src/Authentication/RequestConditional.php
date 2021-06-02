<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Message\Authentication;

use Extly\Http\Message\Authentication;
use Extly\Http\Message\RequestMatcher;
use Psr\Http\Message\RequestInterface;

/**
 * Authenticate a PSR-7 Request if the request is matching the given request matcher.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class RequestConditional implements Authentication
{
    /**
     * @var RequestMatcher
     */
    private $requestMatcher;

    /**
     * @var Authentication
     */
    private $authentication;

    public function __construct(RequestMatcher $requestMatcher, Authentication $authentication)
    {
        $this->requestMatcher = $requestMatcher;
        $this->authentication = $authentication;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(RequestInterface $request)
    {
        if ($this->requestMatcher->matches($request)) {
            return $this->authentication->authenticate($request);
        }

        return $request;
    }
}
