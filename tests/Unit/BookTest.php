<?php

use App\Entity\Author;
use App\Entity\Book;

test('a book can be created using named constructor', function() {
    // ARRANGE
    $author = Author::create(
        id: 321,
        name: 'John Doe',
        bio: 'This is a bio'
    );

    // ACT
    $book = Book::create(
        id: 123,
        title: 'Test book',
        yearPublished: 1999,
        author: $author
    );

    // ASSERT
    expect($book)->toBeInstanceOf(Book::class)
    ->and($book->getId())->toBe(123)
    ->and($book->title)->toBe('Test book')
    ->and($book->yearPublished)->toBe(1999)
    ->and($book->author)->toBe($author)
    ->and($author->name)->toBe('John Doe')
    ->and($author->bio)->toBe('This is a bio')
    ->and(json_encode($book))->toMatchJson([
        'id' => 123,
        'title' => 'Test book',
        'yearPublished' => 1999,
        'author' => [
            'id' => 321,
            'name' => 'John Doe',
            'bio' => 'This is a bio'
        ]
    ]);
});