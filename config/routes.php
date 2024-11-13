<?php

return [
    [
        'GET',
        '/books/{id:\d+}',
        [\App\Controller\BooksController::class, 'show']
    ],
];