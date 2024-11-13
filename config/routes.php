<?php

return [
    [
        'GET',
        '/books/{id:\d+}',
        fn() => new \App\Http\Response()
    ],
];