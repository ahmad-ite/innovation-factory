<?php

namespace Tests\Feature\User;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\User\UserPrefixnameEnum;
use App\Enums\User\UserTypeEnum;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        $response->assertStatus(200);
    }

    public function test_deleted_users_response(): void
    {
        $response = $this->get('/users/trashed');
        $response->assertStatus(200);
    }

    public function test_view_user_response(): void
    {
        // Create a new user and save it to the database
        $user = User::factory()->create();
        $response = $this->get('/users/'.$user->id);
        $response->assertStatus(200);
    }

    public function test_user_create_response(): void
    {
        //init data
        Storage::fake('public');

        $data = [
            'email' => fake()->unique()->safeEmail(),
            'prefixname' => UserPrefixnameEnum::getRandomValue(),
            'firstname' => fake()->firstName(),
            'middlename' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'suffixname' => 'Hr',
            'username' => fake()->unique()->userName(),
            'type' => UserTypeEnum::getRandomValue(),
            'password' => config('default.admin.password'),
            'photo' => UploadedFile::fake()->image('avatar.jpg'),
        ];

        //call store request
        $response = $this->post(route('users.store'), $data);

        //assert
        $response->assertStatus(302);
        $response->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'username' => $data['username'],
            'email' => $data['email'],
        ]);
    }

    public function test_user_update_response(): void
    {
        //init data
        $user = User::factory()->create();
        Storage::fake('public');

        $data = [
            'email' => fake()->unique()->safeEmail(),
            'prefixname' => UserPrefixnameEnum::getRandomValue(),
            'firstname' => fake()->firstName(),
            'middlename' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'suffixname' => 'Hr',
            'username' => fake()->unique()->userName(),

        ];

        //call update request
        $response = $this->put(route('users.update', $user->id), $data);

        //assert
        $response->assertStatus(302);
        $response->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'username' => $data['username'],
            'email' => $data['email'],
        ]);
    }

    public function test_user_destroy_response(): void
    {
        //init data
        $user = User::factory()->create();

        //call destroy request
        $response = $this->delete(route('users.destroy', $user->id));

        //assert
        $response->assertStatus(302);
        $response->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'username' => $user->username,
            'email' => $user->email,
        ]);
    }

    public function test_user_delete_response(): void
    {
        //init data
        $user = User::factory(['deleted_at' => now()])->create();

        //call delete request
        $response = $this->delete(route('users.delete', $user->id));

        //assert
        $response->assertStatus(302);
        $response->assertRedirect(route('users.trashed'));

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    public function test_user_restore_response(): void
    {
        //init data
        $user = User::factory(['deleted_at' => now()])->create();

        //call store request
        $response = $this->patch(route('users.restore', $user->id));

        //assert
        $response->assertStatus(302);
        
        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'username' => $user->username,
            'email' => $user->email,
            'id' => $user->id,
        ]);
    }
}