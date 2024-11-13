<?php

namespace App\Controller;

use App\Http\Response;
use App\Repository\BookRepository;

class BooksController
{
    public function __construct(private BookRepository $bookRepository)
    {
    }

    public function show(int $id): Response
    {
        /*$body = '';
        $statusCode = Response::HTTP_NOT_FOUND;

        if ($id === 1) {
            $body = [
                'id' => 1,
                'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'year_published' => 2008,
                'author' => [
                    'id' => 1,
                    'name' => 'Robert C. Martin',
                    'bio' => 'This is an author'
                ],
            ];

            $statusCode = Response::HTTP_OK;

        };

        if ($id === 2) {
            $body = [
                'id' => 2,
                'title' => 'Refactoring: Improving the Design of Existing Code',
                'year_published' => 1999,
                'author' => [
                    'id' => 2,
                    'name' => 'Martin Fowler',
                    'bio' => 'Martin\'s bio'
                ]
            ];

            $statusCode = Response::HTTP_OK;
        }*/

        $book = $this->bookRepository->findById($id);

        return new Response(body: json_encode($book), statusCode: Response::HTTP_OK);
    }
}