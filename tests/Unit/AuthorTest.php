<?php

use App\Entity\Author;

test('an author can be created using a named constructor', function () {
    // ACT
    $author = Author::create(
        id: 321,
        name: 'John Doe',
        bio: 'This is a bio'
    );

    // ASSERT
    expect($author)->toBeInstanceOf(Author::class)
    ->and($author->getId())->toBe(321)
    ->and($author->name)->toBe('John Doe')
    ->and($author->bio)->toBe('This is a bio');
});