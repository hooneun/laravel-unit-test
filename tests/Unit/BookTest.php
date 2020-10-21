<?php

namespace Tests\Unit;

use App\Models\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{

    public function test_an_author_id_is_recorded()
    {
        Book::create([
            'title' => 'cool title',
            'author_id' => 1,
        ]);

        $this->assertCount(1, Book::all());
    }
}
