<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user, 'web');
    }

    public function test_users_response(): void
    {
        $response = $this->get('/users');
        // dd($response);
        $response->assertStatus(200);
    }
}
