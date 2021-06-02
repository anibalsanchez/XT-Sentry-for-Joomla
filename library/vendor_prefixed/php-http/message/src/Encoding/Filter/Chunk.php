<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Message\Encoding\Filter;

/**
 * Userland implementation of the chunk stream filter.
 *
 * @author Joel Wurtz <joel.wurtz@gmail.com>
 */
class Chunk extends \php_user_filter
{
    /**
     * {@inheritdoc}
     */
    public function filter($in, $out, &$consumed, $closing)
    {
        while ($bucket = stream_bucket_make_writeable($in)) {
            $lenbucket = stream_bucket_new($this->stream, dechex($bucket->datalen)."\r\n");
            stream_bucket_append($out, $lenbucket);

            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);

            $lenbucket = stream_bucket_new($this->stream, "\r\n");
            stream_bucket_append($out, $lenbucket);
        }

        return PSFS_PASS_ON;
    }
}
