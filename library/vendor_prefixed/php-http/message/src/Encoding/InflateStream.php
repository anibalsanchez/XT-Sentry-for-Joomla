<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Message\Encoding;

use Extly\Clue\StreamFilter as Filter;
use Extly\Psr\Http\Message\StreamInterface;

/**
 * Stream inflate (RFC 1951).
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 */
class InflateStream extends FilteredStream
{
    /**
     * @param int $level
     */
    public function __construct(StreamInterface $stream, $level = -1)
    {
        if (!extension_loaded('zlib')) {
            throw new \RuntimeException('The zlib extension must be enabled to use this stream');
        }

        parent::__construct($stream, ['window' => -15]);

        // @deprecated will be removed in 2.0
        $this->writeFilterCallback = Filter\fun($this->writeFilter(), ['window' => -15, 'level' => $level]);
    }

    /**
     * {@inheritdoc}
     */
    protected function readFilter()
    {
        return 'zlib.inflate';
    }

    /**
     * {@inheritdoc}
     */
    protected function writeFilter()
    {
        return 'zlib.deflate';
    }
}
