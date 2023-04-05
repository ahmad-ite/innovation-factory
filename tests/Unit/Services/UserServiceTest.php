<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithoutEvents;
use Illuminate\Http\Request;
use Tests\TestCase;
use Tests\Traits\AssertHelper;

/**
 * @runTestsInSeparateProcesses
 *
 * @preserveGlobalState disabled
 */
class UserServiceTest extends TestCase
{
    use  AssertHelper; //, WithoutEvents;

    protected $userService = null;

    public function setUp(): void
    {
        parent::setUp();

        //refresh db
        $this->refreshDatabase();
        // Create a new user model
        $userModel = new User();

        // Create an instance of the UserService class and pass in the required dependencies
        $this->userService = new UserService($userModel, new Request());
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_return_a_paginated_list_of_users()
    {
        // Create a new user and save it to the database
        $users = User::factory()->count(10)->create();

        //call list service
        $paginator = $this->userService->list();
        $response = $paginator->toArray();

        //assert Paginated with data
        $this->assertPaginated($response, [
            'total' => $users->count(),
            'per_page' => config('default.pagination.size'),
            'current_page' => 1,
            'last_page' => ceil($users->count() / config('default.pagination.size')),
            'prev_page_url' => null,
            'next_page_url' => config('app.url').'?page=2',
            'data' => User::latest()->paginate(config('default.pagination.size'))->toArray()['data'],
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_store_a_user_to_database()
    {
        // dd(User::count());
        $this->assertEquals(0, User::count());

        // Actions

        // Assertions
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_find_and_return_an_existing_user()
    {
        // Create a new user and save it to the database
        $user = User::factory()->create();

        // Create an instance of the UserService class and pass in the required dependencies
        $userService = new UserService($user, new Request());

        // dd($userService->list());

        // Call the getUserById method and assert that it returns the correct user
        $this->assertEquals($user->id, $userService->find($user->id)->id);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_update_an_existing_user()
    {
        // Arrangements

        // Actions

        // Assertions
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_soft_delete_an_existing_user()
    {
        // Arrangements

        // Actions

        // Assertions
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_return_a_paginated_list_of_trashed_users()
    {
        // Arrangements

        // Actions

        // Assertions
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_restore_a_soft_deleted_user()
    {
        // Arrangements

        // Actions

        // Assertions
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_permanently_delete_a_soft_deleted_user()
    {
        // Arrangements

        // Actions

        // Assertions
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_upload_photo()
    {
        // Arrangements

        // Actions

        // Assertions
    }

    public function it_can_handle_saving_details_users()
    {
        // Create a new user and save it to the database
        $user = User::factory()->create();

        //call handleSavingDetails  service
        $this->assertEquals($this->userService->handleSavingDetails($user), true);

        dd($user);
    }
}
