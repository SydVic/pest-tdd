<?php

use App\Http\Response;

test('a response object can be created', function () {
    // ACT
    $response = new Response('{"foo": "bar"}', 200);

    // ASSERT
    expect($response->getStatusCode())->toBeInt()->toBe(200)
    ->and($response->getBody())->toMatchJson([
        'foo' => 'bar',
    ]);
});