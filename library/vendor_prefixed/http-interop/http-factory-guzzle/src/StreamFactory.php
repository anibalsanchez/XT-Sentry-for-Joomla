<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Factory\Guzzle;

use Extly\GuzzleHttp\Psr7\Stream;
use Extly\GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

use function Extly\GuzzleHttp\Psr7\stream_for;
use function Extly\GuzzleHttp\Psr7\try_fopen;

class StreamFactory implements StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface
    {
        if (\function_exists('stream_for')) {
            // fallback for guzzlehttp/psr7<1.7.0
            return stream_for($content);
        }
        return Utils::streamFor($content);
    }

    public function createStreamFromFile(string $file, string $mode = 'r'): StreamInterface
    {
        if (\function_exists('try_fopen') && \function_exists('steam_for')) {
            // fallback for guzzlehttp/psr7<1.7.0
            $resource = try_fopen($file, $mode);

            return stream_for($resource);
        }
        $resource = Utils::tryFopen($file, $mode);

        return new Stream($resource);
    }

    public function createStreamFromResource($resource): StreamInterface
    {
        if (\function_exists('stream_for')) {
            // fallback for guzzlehttp/psr7<1.7.0
            return stream_for($resource);
        }
        return new Stream($resource);
    }
}
