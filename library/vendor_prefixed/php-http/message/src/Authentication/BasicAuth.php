<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Message\Authentication;

use Extly\Http\Message\Authentication;
use Psr\Http\Message\RequestInterface;

/**
 * Authenticate a PSR-7 Request using Basic Auth.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class BasicAuth implements Authentication
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(RequestInterface $request)
    {
        $header = sprintf('Basic %s', base64_encode(sprintf('%s:%s', $this->username, $this->password)));

        return $request->withHeader('Authorization', $header);
    }
}
