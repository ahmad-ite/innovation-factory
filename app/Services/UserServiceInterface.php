<?php

namespace App\Services;

interface UserServiceInterface
{
    /**
     * Generate random hash key.
     *
     * @return string
     */
    public function hash(string $key);

    public function list();
}
