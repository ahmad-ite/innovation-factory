<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface
{
    /**
     * Generate random hash key.
     *
     * @return string
     */


    public function list();

    public function store(array $attributes);

    public function find(int $id): ?Model;

    public function update(int $id, array $attributes): bool;

    public function destroy($id);

    public function listTrashed();

    public function restore($id);

    public function delete($id);
}
