<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Message\Authentication;

use Extly\Http\Message\Authentication;
use Extly\Psr\Http\Message\RequestInterface;

class Header implements Authentication
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|array
     */
    private $value;

    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(RequestInterface $request)
    {
        return $request->withHeader($this->name, $this->value);
    }
}
