<?php

namespace App\Repository;

use App\Database\Connection;
use App\Entity\Author;
use App\Entity\Book;

class BookRepository
{
    public function __construct(private Connection $connection)
    {

    }

    public function findById(int $id): ?Book
    {
        // Obtain PDO instance
        $pdo = $this->connection->getPdo();

        // Prepare the statement (SQL)
        $stmt = $pdo->prepare("
            SELECT
                books.id,
                books.title,
                books.year_published,
                authors.id as author_id,
                authors.name as author_name,
                authors.bio as author_bio
            FROM
                books
            INNER JOIN
                authors
            ON
                books.author_id = authors.id
            WHERE
                books.id = :id
            
        ");

        // Execute the statement
        $stmt->execute(['id' => $id]);

        // Fetch the data
        $row = $stmt->fetch();

        // Check existence of a row
        if (!$row) {
            return null;
        }

        $author = Author::create(
            id: $row['author_id'],
            name: $row['author_name'],
            bio: $row['author_bio']
        );

        // Use it to create and hydrate a Book
        $book = Book::create(
            id: $row['id'],
            title: $row['title'],
            yearPublished: $row['year_published'],
            author: $author
        );

        // return the Book
        return $book;
    }
}