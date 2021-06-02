<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Factory\Guzzle;

use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

class StreamFactory implements StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface
    {
        return \Extly\GuzzleHttp\Psr7\stream_for($content);
    }

    public function createStreamFromFile(string $file, string $mode = 'r'): StreamInterface
    {
        $resource = \Extly\GuzzleHttp\Psr7\try_fopen($file, $mode);

        return \Extly\GuzzleHttp\Psr7\stream_for($resource);
    }

    public function createStreamFromResource($resource): StreamInterface
    {
        return \Extly\GuzzleHttp\Psr7\stream_for($resource);
    }
}
