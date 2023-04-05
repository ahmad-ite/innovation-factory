<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService implements UserServiceInterface
{
    /**
     * The model instance.
     *
     * @var App\User
     */
    protected $model;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Constructor to bind model to a repository.
     */
    public function __construct(User $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Define the validation rules for the model.
     *
     * @param  int  $id
     * @return array
     */
    public function rules($id = null)
    {
        return [
            /**
             * Rule syntax:
             * 'column' => 'validation1|validation2'
             *
             * or
             *
             * 'column' => ['validation1', function1()]
             */
            'prefixname' => 'string.required',
            'firstname' => 'string|required',
            'middlename' => 'string|required',
            'lastname' => 'string|required',
            'suffixname' => 'string|required',
            'username' => 'string|required',
            'email' => 'email|required',
            'password' => 'required',
            'photo' => 'required',
        ];
    }

    /**
     * Retrieve all resources and paginate.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function list():LengthAwarePaginator
    {
        // dd($this->model->latest()->paginate(config('default.pagination.size')));
        return $this->model->latest()->paginate(config('default.pagination.size'));
    }

    /**
     * Create model resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes)
    {
        // Code goes brrrr.
    }

    /**
     * Retrieve model resource details.
     * Abort to 404 if not found.
     */
    public function find(int $id): ?Model
    {
        // Code goes brrrr.
    }

    /**
     * Update model resource.
     */
    public function update(int $id, array $attributes): bool
    {
        // Code goes brrrr.
    }

    /**
     * Soft delete model resource.
     *
     * @param  int|array  $id
     * @return void
     */
    public function destroy($id)
    {
        // Code goes brrrr.
    }

    /**
     * Include only soft deleted records in the results.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listTrashed()
    {
        // Code goes brrrr.
    }

    /**
     * Restore model resource.
     *
     * @param  int|array  $id
     * @return void
     */
    public function restore($id)
    {
        // Code goes brrrr.
    }

    /**
     * Permanently delete model resource.
     *
     * @param  int|array  $id
     * @return void
     */
    public function delete($id)
    {
        // Code goes brrrr.
    }

    /**
     * Generate random hash key.
     */
    public function hash(string $key): string
    {
        // Code goes brrrr.
    }

    /**
     * Upload the given file.
     *
     * @return string|null
     */
    public function upload(UploadedFile $file)
    {
        // Code goes brrrr.
    }
}