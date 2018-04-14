<?php

namespace wbadrh\API;

// http://booboo.thephpleague.com/
use League\BooBoo\BooBoo;
use League\BooBoo\Formatter\JsonFormatter;

// http://route.thephpleague.com/
use League\Container\Container;
use League\Route\RouteCollection;
use League\Route\RouteGroup;
use League\Route\Strategy\JsonStrategy;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;

use \Closure;

/**
 * Router
 */
class Router
{
    /**
     * PSR-7 router
     *
     * @param String  $scheme Request scheme, manual input to validate
     * @param String  $host   HTTP host, manual input to valiidate
     * @param Closure $routes Application routes, anonymous function
     */
    function __construct(String $scheme, String $host, Closure $routes)
    {
        // JSON error handling
        (new BooBoo([new JsonFormatter]))->register();

        // FastRoute
        $container = new Container;

        $container->share('response', Response::class);
        $container->share('request', function() {
            return ServerRequestFactory::fromGlobals(
                $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
            );
        });

        $container->share('emitter', SapiEmitter::class);
        $router = new RouteCollection($container);

        // Application routes
        $router->group('/', $routes)
            ->setScheme($scheme)            // Validate request protocol
            ->setHost($host)                // Validate request domain
            ->setStrategy(new JsonStrategy) // Rest API
        ;

        // Dispatch to browser
        $container->get('emitter')->emit(
            $router->dispatch(
                $container->get('request'),
                $container->get('response')
            )
        );
    }
}
