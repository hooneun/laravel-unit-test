<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_author_can_be_created()
    {
//        $this->withoutExceptionHandling();
        $response = $this->post('/author', [
            'name' => 'Author Name',
            'dob' => '05/14/1998',
        ]);

        $authorId = $response->json('author')['id'];
        $author = Author::find($authorId);

//        $this->assertCount(1, $author->count());
        $this->assertInstanceOf(Carbon::class, $author->dob);
        $this->assertEquals('Author Name', $author->name);
        $this->assertEquals('1998-05-14', $author->dob->format('Y-m-d'));
    }
}
