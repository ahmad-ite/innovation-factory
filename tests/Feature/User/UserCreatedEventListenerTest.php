<?php

namespace Tests\Feature\User;

use App\Events\UserSaved;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UserCreatedEventListenerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_created_event_fires()
    {
        Event::fake();

        // Create a new user
        $user = User::factory()->create();

        // Assert that the UserSaved event was fired
        Event::assertDispatched(UserSaved::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }
}
