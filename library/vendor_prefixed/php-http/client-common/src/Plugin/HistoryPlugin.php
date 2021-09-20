<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

declare(strict_types=1);

namespace Extly\Http\Client\Common\Plugin;

use Extly\Http\Client\Common\Plugin;
use Extly\Http\Promise\Promise;
use Extly\Psr\Http\Client\ClientExceptionInterface;
use Extly\Psr\Http\Message\RequestInterface;
use Extly\Psr\Http\Message\ResponseInterface;

/**
 * Record HTTP calls.
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 */
final class HistoryPlugin implements Plugin
{
    /**
     * Journal use to store request / responses / exception.
     *
     * @var Journal
     */
    private $journal;

    public function __construct(Journal $journal)
    {
        $this->journal = $journal;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $journal = $this->journal;

        return $next($request)->then(function (ResponseInterface $response) use ($request, $journal) {
            $journal->addSuccess($request, $response);

            return $response;
        }, function (ClientExceptionInterface $exception) use ($request, $journal) {
            $journal->addFailure($request, $exception);

            throw $exception;
        });
    }
}
