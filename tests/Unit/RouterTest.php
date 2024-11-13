<?php

use App\Http\Response;
use App\Routing\RouteHandlerResolver;

it('returns a 200 Response object if a valid route exists', function () {
    // ARRANGE
    $request = \App\Http\Request::create('GET', '/foo');
    $handler = fn () => new \App\Http\Response();
    $routeHandlerResolver = Mockery::mock(\App\Routing\RouteHandlerResolver::class);
    $routeHandlerResolver->shouldReceive('resolve')
        ->andReturn($handler);

    $router = new \App\Routing\Router($routeHandlerResolver);

    $router->setRoutes([
       ['GET', '/foo', $handler],
    ]);

    // ACT
    $response = $router->dispatch($request);

    // ASSERT
    expect($response)
        ->toBeInstanceOf(\App\Http\Response::class)
        ->and($response->getStatusCode())
        ->toBe(Response::HTTP_OK);
});

it('returns a 404 Response object if a route does not exist', function () {
    // ARRANGE
    $request = \App\Http\Request::create('GET', '/bar');
    $handler = fn () => new \App\Http\Response();
    $routeHandlerResolver = Mockery::mock(\App\Routing\RouteHandlerResolver::class);
    $routeHandlerResolver->shouldReceive('resolve')
        ->andReturn($handler);

    $router = new \App\Routing\Router($routeHandlerResolver);

    $router->setRoutes([
        ['GET', '/foo', $handler],
    ]);

    // ACT
    $response = $router->dispatch($request);

    // ASSERT
    expect($response)
        ->toBeInstanceOf(\App\Http\Response::class)
        ->and($response->getStatusCode())
        ->toBe(Response::HTTP_NOT_FOUND);
});

it('returns a 405 Response object if a not allowed method is used', function () {
    // ARRANGE
    $request = \App\Http\Request::create('POST', '/foo');
    $handler = fn () => new \App\Http\Response();
    $routeHandlerResolver = Mockery::mock(\App\Routing\RouteHandlerResolver::class);
    $routeHandlerResolver->shouldReceive('resolve')
        ->andReturn($handler);

    $router = new \App\Routing\Router($routeHandlerResolver);

    $router->setRoutes([
        ['GET', '/foo', $handler],
    ]);

    // ACT
    $response = $router->dispatch($request);

    // ASSERT
    expect($response)
        ->toBeInstanceOf(\App\Http\Response::class)
        ->and($response->getStatusCode())
        ->toBe(Response::HTTP_METHOD_NOT_ALLOWED);
});