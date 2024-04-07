<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest  extends TestCase
{
    use RefreshDatabase;

    public function test_get_books(): void
    {
        $response = $this->get('/api/v1/books');

        $response->assertStatus(200);
    }

    public function test_show_book(): void
    {
        $book = Book::factory()->create();
        $response = $this->get('/api/v1/books/' . $book->id);

        $response->assertStatus(200);
    }

    public function test_store_book(): void
    {
        $response = $this->post('/api/v1/books', ['name' => 'test', 'isbn' => '2983183', 'value' => 0.75]);

        $response->assertCreated();
    }

    public function test_update_book(): void
    {
        $book = Book::factory()->create();
        $new_book = ['name' => 'new_name',  'isbn' => '5678', 'value' => '2.30'];
        $response = $this->put('/api/v1/books/' . $book->id, $new_book);

        $response->assertStatus(200);
    }

    public function test_delete_book(): void
    {
        $book = Book::factory()->create();

        $response = $this->delete('/api/v1/books/' . $book->id);

        $response->assertStatus(200);
    }

    public function test_book_attach_stores(): void
    {
        $book = Book::factory()->create();
        $store = Store::factory()->create();

        $response = $this->post('/api/v1/books/' . $book->id . '/stores', ['stores' => [$store->id]]);

        $response->assertStatus(200);
    }
}
