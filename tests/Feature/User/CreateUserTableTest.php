<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreateUserTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_users_table_with_required_columns()
    {
        $this->assertTrue(Schema::hasTable('users'));

        $this->assertTrue(Schema::hasColumns('users', [
            'id',
            'prefixname',
            'firstname',
            'middlename',
            'lastname',
            'suffixname',
            'username',
            'email',
            'photo',
            'type',
            'email_verified_at',
            'password',
            'remember_token',
            'created_at',
            'updated_at',
            'deleted_at',
        ]));
    }
}
