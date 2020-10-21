<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
//        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'cool book title',
            'author' => 'harry'
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {
//        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'harry',
        ]);
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function an_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'cool book title',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
//        $this->withoutExceptionHandling();
        $this->post('/books', [
            'title' => 'coll book title',
            'author' => 'harry',
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id, [
            'title' => 'New Title',
            'author' => 'Victor',
        ]);

        $resBook = $response->json()['book'];
        $updatedBook = Book::find($resBook['id']);

        $this->assertEquals('New Title', $resBook['title']);
        $this->assertEquals('Victor', $resBook['author']);
        $this->assertEquals('New Title', $updatedBook->title);
        $this->assertEquals('Victor', $updatedBook->author);
    }
}
