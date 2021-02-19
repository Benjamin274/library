<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookReservatonTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_be_added_to_library()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/books',['title'=>'Book Title','author'=>'Vectore me']);
        $response->assertStatus(200);
        $this->assertCount(1,Book::all());
    }
    public function test_a_title_is_required()
    {
        $response = $this->post('/books',['title'=>'','author'=>'Vectore me']);

        $response->assertSessionHasErrors('title');
    }
    public function test_a_author_is_required()
    {
        $response = $this->post('/books',['title'=>'cool Title','author'=>'']);

        $response->assertSessionHasErrors('author');
    }

    public function test_a_book_can_be_updated()
    {

        $this->withoutExceptionHandling();
        $this->post('/books',['title'=>'cool Title','author'=>'Benjamin']);
        $this->patch('/books/'.Book::first()->id,['title'=>'New Title','author'=>'Loza']);

        $this->assertEquals('New Title',Book::first()->title);
        $this->assertEquals('Loza',Book::first()->author);
    }
}
