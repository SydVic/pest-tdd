<?php

return [
    [
        'GET',
        '/books/{id:\d+}',
        [\App\Controller\BookController::class, 'show']
    ],
];