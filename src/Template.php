<?php

namespace wbadrh\API;

// http://route.thephpleague.com/json-strategy/

// http://route.thephpleague.com/
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
//use League\Route\Http\Exception\NotFoundException;
//use League\Route\Http\Exception\BadRequestException;

/**
 * ...
 */
class Template
{
    /**
     * ...
     *
     * @param ServerRequestInterface   $request  Zend Diactoros server request
     * @param ResponseInterface        $response PSR-7 HTTP response message
     * @return Zend\Diactoros\Response $response Manipulated PSR-7 HTTP response message
     */
    public function response(ServerRequestInterface $request, ResponseInterface $response)
    {
        // Demo contents
        $contents = 'It works!';

        // Write Response to Body
        $response->getBody()->write($contents);

        // PSR-7 response
        return $response;
    }

    /**
     * ...
     *
     * @param ServerRequestInterface   $request  Zend Diactoros server request
     * @param ResponseInterface        $response PSR-7 HTTP response message
     * @param Array                    $args     URL query parameters
     * @return Zend\Diactoros\Response $response Manipulated PSR-7 HTTP response message
     */
    public function response_args(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        // Demo contents
        $contents = 'Hello, ' . $args['name'] . '!';

        // Write Response to Body
        $response->getBody()->write($contents);

        // PSR-7 response
        return $response;
    }
}
