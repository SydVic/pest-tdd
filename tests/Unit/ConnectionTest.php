<?php

use App\Database\Connection;

it('returns a valid pdo instance', function() {
    // ARRANGE
    $connection = new Connection('sqlite::memory:');

    // ACT
    $pdo = $connection->getPdo();

    // ASSERT
    expect($pdo)->toBeInstanceOf(PDO::class);
});