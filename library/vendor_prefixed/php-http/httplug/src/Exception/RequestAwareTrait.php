<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Client\Exception;

use Extly\Psr\Http\Message\RequestInterface;

trait RequestAwareTrait
{
    /**
     * @var RequestInterface
     */
    private $request;

    private function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
