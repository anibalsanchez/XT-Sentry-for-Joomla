<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Factory\Guzzle;

use Extly\GuzzleHttp\Psr7\Stream;
use Extly\GuzzleHttp\Psr7\Utils;
use Extly\Psr\Http\Message\StreamFactoryInterface;
use Extly\Psr\Http\Message\StreamInterface;

use function function_exists;
use function Extly\GuzzleHttp\Psr7\stream_for;
use function Extly\GuzzleHttp\Psr7\try_fopen;

class StreamFactory implements StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface
    {
        if (function_exists('Extly\GuzzleHttp\Psr7\stream_for')) {
            // fallback for guzzlehttp/psr7<1.7.0
            return stream_for($content);
        }

        return Utils::streamFor($content);
    }

    public function createStreamFromFile(string $file, string $mode = 'r'): StreamInterface
    {
        if (function_exists('Extly\GuzzleHttp\Psr7\try_fopen')) {
            // fallback for guzzlehttp/psr7<1.7.0
            $resource = try_fopen($file, $mode);
        } else {
            $resource = Utils::tryFopen($file, $mode);
        }


        return $this->createStreamFromResource($resource);
    }

    public function createStreamFromResource($resource): StreamInterface
    {
        return new Stream($resource);
    }
}
