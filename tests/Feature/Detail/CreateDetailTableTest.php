<?php

namespace Tests\Feature\Detail;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreateDetailTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_users_table_with_required_columns()
    {
        $this->assertTrue(Schema::hasTable('details'));

        $this->assertTrue(Schema::hasColumns('details', [
            'id',
            'key',
            'value',
            'icon',
            'status',
            'type',
            'user_id',
            'created_at',
            'updated_at',
        ]));
    }
}
