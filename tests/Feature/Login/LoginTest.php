<?php

namespace Tests\Feature\Login;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_login_successful_response(): void
    {
        // Get the CSRF token
        $token = csrf_token();

        // Make a POST request to a Fortify route with the CSRF token
        $response = $this->post('/login', [
            'email' => config('default.admin.email'),
            'password' => config('default.admin.password'),
            '_token' => $token, // Include the CSRF token in the request data
        ]);
        $response->assertStatus(302);
    }
}