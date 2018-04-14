<?php

require __DIR__ . '/../vendor/autoload.php';

new \wbadrh\API\Router
(
    // Request scheme
    'http',

    // HTTP host
    'api.test',

    /**
     * Application routes
     *
     * @param RouteGroup $router League route group
     */
    function(League\Route\RouteGroup $router)
    {
        /*
            // http://route.thephpleague.com/request-verbs/

            $router->get();
            $router->post();
            $router->put();
            $router->patch();
            $router->delete();
            $router->head();
            $router->options();

            // http://route.thephpleague.com/wildcard-routes/

            // http://route.thephpleague.com/controllers/
        */

        // Demo response
        $router->get('/', 'wbadrh\API\Template::response');
        $router->get('/{name}', 'wbadrh\API\Template::response_args');
    }
);
