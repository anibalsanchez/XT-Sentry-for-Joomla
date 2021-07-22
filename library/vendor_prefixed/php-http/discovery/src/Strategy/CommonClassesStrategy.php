<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Sentry for Joomla Library" */

namespace Extly\Http\Discovery\Strategy;

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Extly\Http\Client\HttpAsyncClient;
use Extly\Http\Client\HttpClient;
use Extly\Http\Discovery\Exception\NotFoundException;
use Extly\Http\Discovery\MessageFactoryDiscovery;
use Extly\Http\Discovery\Psr17FactoryDiscovery;
use Extly\Http\Message\RequestFactory;
use Psr\Http\Message\RequestFactoryInterface as Psr17RequestFactory;
use Extly\Http\Message\MessageFactory;
use Extly\Http\Message\MessageFactory\GuzzleMessageFactory;
use Extly\Http\Message\StreamFactory;
use Extly\Http\Message\StreamFactory\GuzzleStreamFactory;
use Extly\Http\Message\UriFactory;
use Extly\Http\Message\UriFactory\GuzzleUriFactory;
use Extly\Http\Message\MessageFactory\DiactorosMessageFactory;
use Extly\Http\Message\StreamFactory\DiactorosStreamFactory;
use Extly\Http\Message\UriFactory\DiactorosUriFactory;
use Psr\Http\Client\ClientInterface as Psr18Client;
use Zend\Diactoros\Request as DiactorosRequest;
use Extly\Http\Message\MessageFactory\SlimMessageFactory;
use Extly\Http\Message\StreamFactory\SlimStreamFactory;
use Extly\Http\Message\UriFactory\SlimUriFactory;
use Slim\Http\Request as SlimRequest;
use GuzzleHttp\Client as GuzzleHttp;
use Extly\Http\Adapter\Guzzle7\Client as Guzzle7;
use Extly\Http\Adapter\Guzzle6\Client as Guzzle6;
use Extly\Http\Adapter\Guzzle5\Client as Guzzle5;
use Extly\Http\Client\Curl\Client as Curl;
use Extly\Http\Client\Socket\Client as Socket;
use Extly\Http\Adapter\React\Client as React;
use Extly\Http\Adapter\Buzz\Client as Buzz;
use Extly\Http\Adapter\Cake\Client as Cake;
use Extly\Http\Adapter\Zend\Client as Zend;
use Extly\Http\Adapter\Artax\Client as Artax;
use Symfony\Component\HttpClient\HttplugClient as SymfonyHttplug;
use Symfony\Component\HttpClient\Psr18Client as SymfonyPsr18;
use Nyholm\Psr7\Factory\HttplugFactory as NyholmHttplugFactory;

/**
 * @internal
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class CommonClassesStrategy implements DiscoveryStrategy
{
    /**
     * @var array
     */
    private static $classes = [
        MessageFactory::class => [
            ['class' => NyholmHttplugFactory::class, 'condition' => [NyholmHttplugFactory::class]],
            ['class' => GuzzleMessageFactory::class, 'condition' => [GuzzleRequest::class, GuzzleMessageFactory::class]],
            ['class' => DiactorosMessageFactory::class, 'condition' => [DiactorosRequest::class, DiactorosMessageFactory::class]],
            ['class' => SlimMessageFactory::class, 'condition' => [SlimRequest::class, SlimMessageFactory::class]],
        ],
        StreamFactory::class => [
            ['class' => NyholmHttplugFactory::class, 'condition' => [NyholmHttplugFactory::class]],
            ['class' => GuzzleStreamFactory::class, 'condition' => [GuzzleRequest::class, GuzzleStreamFactory::class]],
            ['class' => DiactorosStreamFactory::class, 'condition' => [DiactorosRequest::class, DiactorosStreamFactory::class]],
            ['class' => SlimStreamFactory::class, 'condition' => [SlimRequest::class, SlimStreamFactory::class]],
        ],
        UriFactory::class => [
            ['class' => NyholmHttplugFactory::class, 'condition' => [NyholmHttplugFactory::class]],
            ['class' => GuzzleUriFactory::class, 'condition' => [GuzzleRequest::class, GuzzleUriFactory::class]],
            ['class' => DiactorosUriFactory::class, 'condition' => [DiactorosRequest::class, DiactorosUriFactory::class]],
            ['class' => SlimUriFactory::class, 'condition' => [SlimRequest::class, SlimUriFactory::class]],
        ],
        HttpAsyncClient::class => [
            ['class' => SymfonyHttplug::class, 'condition' => [SymfonyHttplug::class, Promise::class, RequestFactory::class, [self::class, 'isPsr17FactoryInstalled']]],
            ['class' => Guzzle7::class, 'condition' => Guzzle7::class],
            ['class' => Guzzle6::class, 'condition' => Guzzle6::class],
            ['class' => Curl::class, 'condition' => Curl::class],
            ['class' => React::class, 'condition' => React::class],
        ],
        HttpClient::class => [
            ['class' => SymfonyHttplug::class, 'condition' => [SymfonyHttplug::class, RequestFactory::class, [self::class, 'isPsr17FactoryInstalled']]],
            ['class' => Guzzle7::class, 'condition' => Guzzle7::class],
            ['class' => Guzzle6::class, 'condition' => Guzzle6::class],
            ['class' => Guzzle5::class, 'condition' => Guzzle5::class],
            ['class' => Curl::class, 'condition' => Curl::class],
            ['class' => Socket::class, 'condition' => Socket::class],
            ['class' => Buzz::class, 'condition' => Buzz::class],
            ['class' => React::class, 'condition' => React::class],
            ['class' => Cake::class, 'condition' => Cake::class],
            ['class' => Zend::class, 'condition' => Zend::class],
            ['class' => Artax::class, 'condition' => Artax::class],
            [
                'class' => [self::class, 'buzzInstantiate'],
                'condition' => [\Buzz\Client\FileGetContents::class, \Buzz\Message\ResponseBuilder::class],
            ],
        ],
        Psr18Client::class => [
            [
                'class' => [self::class, 'symfonyPsr18Instantiate'],
                'condition' => [SymfonyPsr18::class, Psr17RequestFactory::class],
            ],
            [
                'class' => GuzzleHttp::class,
                'condition' => [self::class, 'isGuzzleImplementingPsr18'],
            ],
            [
                'class' => [self::class, 'buzzInstantiate'],
                'condition' => [\Buzz\Client\FileGetContents::class, \Buzz\Message\ResponseBuilder::class],
            ],
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public static function getCandidates($type)
    {
        if (Psr18Client::class === $type) {
            return self::getPsr18Candidates();
        }

        return self::$classes[$type] ?? [];
    }

    /**
     * @return array The return value is always an array with zero or more elements. Each
     *               element is an array with two keys ['class' => string, 'condition' => mixed].
     */
    private static function getPsr18Candidates()
    {
        $candidates = self::$classes[Psr18Client::class];

        // HTTPlug 2.0 clients implements PSR18Client too.
        foreach (self::$classes[HttpClient::class] as $c) {
            try {
                if (is_subclass_of($c['class'], Psr18Client::class)) {
                    $candidates[] = $c;
                }
            } catch (\Throwable $e) {
                trigger_error(sprintf('Got exception "%s (%s)" while checking if a PSR-18 Client is available', get_class($e), $e->getMessage()), E_USER_WARNING);
            }
        }

        return $candidates;
    }

    public static function buzzInstantiate()
    {
        return new \Buzz\Client\FileGetContents(MessageFactoryDiscovery::find());
    }

    public static function symfonyPsr18Instantiate()
    {
        return new SymfonyPsr18(null, Psr17FactoryDiscovery::findResponseFactory(), Psr17FactoryDiscovery::findStreamFactory());
    }

    public static function isGuzzleImplementingPsr18()
    {
        return defined('GuzzleHttp\ClientInterface::MAJOR_VERSION');
    }

    /**
     * Can be used as a condition.
     *
     * @return bool
     */
    public static function isPsr17FactoryInstalled()
    {
        try {
            Psr17FactoryDiscovery::findResponseFactory();
        } catch (NotFoundException $e) {
            return false;
        } catch (\Throwable $e) {
            trigger_error(sprintf('Got exception "%s (%s)" while checking if a PSR-17 ResponseFactory is available', get_class($e), $e->getMessage()), E_USER_WARNING);

            return false;
        }

        return true;
    }
}