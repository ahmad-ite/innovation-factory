<?php

namespace Tests\Traits;

trait AssertHelper
{
    public function assertPaginated($paginator, $expected)
    {
        $this->assertEquals($expected['total'], $paginator['total']);
        $this->assertEquals($expected['per_page'], $paginator['per_page']);
        $this->assertEquals($expected['current_page'], $paginator['current_page']);
        $this->assertEquals($expected['last_page'], $paginator['last_page']);
        $this->assertEquals($expected['prev_page_url'], $paginator['prev_page_url']);
        $this->assertEquals($expected['next_page_url'], $paginator['next_page_url']);
        $this->assertEquals($expected['data'], $paginator['data']);
    }
}
