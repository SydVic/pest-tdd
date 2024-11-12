<?php

it('creates a correctly formed GET Request object', function () {
    // ACT
    $request = \App\Http\Request::create(
        method: 'GET',
        uri: '/some/path?black=white&day=night',
        server: [
            'CONTENT_TYPE' => 'application/json',
            'Accept'       => 'application/json'
        ],
        content: ''
    );

    // ASSERT
    expect($request->getQueryParams())
        ->toMatchArray(['black' => 'white', 'day' => 'night'])
        ->and($request->getPath())
        ->toBe('/some/path')
        ->and($request->getMethod())
        ->toBe('GET');
});