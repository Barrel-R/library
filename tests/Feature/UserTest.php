<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_users(): void
    {
        $response = $this->get('/api/v1/users');

        $response->assertStatus(200);
    }

    public function test_show_book(): void
    {
        $user = User::factory()->create();
        $response = $this->get('/api/v1/users/' . $user->id);

        $response->assertStatus(200);
    }

    public function test_store_user(): void
    {
        $response = $this->post('/api/v1/users', ['name' => 'test', 'email' => 'testemail@email.com', 'password' => '29138129389129']);

        $response->assertCreated();
    }

    public function test_update_user(): void
    {
        $user = User::factory()->create();
        $new_user = ['name' => 'new_name',  'email' => 'newemail@email.com', 'password' => '123091280930'];
        $response = $this->put('/api/v1/users/' . $user->id, $new_user);

        $response->assertStatus(200);
    }

    public function test_delete_user(): void
    {
        $user = User::factory()->create();

        $response = $this->delete('/api/v1/users/' . $user->id);

        $response->assertStatus(200);
    }
}
