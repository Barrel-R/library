<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest  extends TestCase
{
    use RefreshDatabase;

    public function test_get_stores(): void
    {
        $response = $this->get('/api/v1/stores');

        $response->assertStatus(200);
    }

    public function test_show_store(): void
    {
        $store = Store::factory()->create();
        $response = $this->get('/api/v1/stores/' . $store->id);

        $response->assertStatus(200);
    }

    public function test_create_store(): void
    {
        $response = $this->post('/api/v1/stores', ['name' => 'test', 'address' => 'Test Street', 'active' => 1]);

        $response->assertCreated();
    }

    public function test_update_store(): void
    {
        $store = Store::factory()->create();
        $new_store = ['name' => 'New Store',  'adress' => 'New Store Address', 'active' => '0'];
        $response = $this->put('/api/v1/stores/' . $store->id, $new_store);

        $response->assertStatus(200);
    }

    public function test_delete_store(): void
    {
        $store = Store::factory()->create();

        $response = $this->delete('/api/v1/stores/' . $store->id);

        $response->assertStatus(200);
    }

    public function test_store_attach_books(): void
    {
        $store = Store::factory()->create();
        $book = Book::factory()->create();
        $response = $this->post('/api/v1/stores/' . $store->id . '/books', ['books' => [$book->id]]);

        $response->assertStatus(200);
    }
}
