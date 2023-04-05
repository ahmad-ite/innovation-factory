<?php

namespace App\Services;

use App\Enums\Detail\DetailKeysEnum;
use App\Enums\Detail\DetailTypeEnum;
use App\Enums\User\UserPrefixnameEnum;
use App\Enums\User\UserTypeEnum;
use App\Models\Detail;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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

            'prefixname' => [UserPrefixnameEnum::getValuesAsInRule()],
            'firstname' => 'string|required|max:255',
            'middlename' => 'string|max:255',
            'lastname' => 'string|required|max:255',
            'suffixname' => 'string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class)->ignore($id),
            ],
            'type' => [UserTypeEnum::getValuesAsInRule(), 'required'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($id),
            ],
            'password' => $id ? '' : 'string|required|min:6',
            'photo' => [
                'nullable',
                'image',
                'max:2048', // Maximum file size in kilobytes
            ],
        ];
    }

    /**
     * Retrieve all resources and paginate.
     */
    public function list(): LengthAwarePaginator
    {
        return $this->model->latest()->paginate(config('default.pagination.size'));
    }

    /**
     * Create model resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes)
    {
        $user = new User;
        $user->prefixname = $attributes['prefixname'] ?? null;
        $user->firstname = $attributes['firstname'];
        $user->middlename = $attributes['middlename'] ?? null;
        $user->lastname = $attributes['lastname'];
        $user->suffixname = $attributes['suffixname'] ?? null;
        $user->username = $attributes['username'];
        $user->email = $attributes['email'];
        $user->password = $attributes['password'];
        $user->type = $attributes['type'];

        if ($this->request->hasFile('photo')) {
            $user->photo = $this->upload($this->request->photo);
        }

        return $user->save();
    }

    /**
     * Retrieve model resource details.
     * Abort to 404 if not found.
     */
    public function find(int $id): ?Model
    {
        return $this->model->withTrashed()->find($id);
    }

    /**
     * Update model resource.
     */
    public function update(int $id, array $attributes): bool
    {
        $user = $this->find($id);
        $user->prefixname = $attributes['prefixname'] ?? $user->prefixname;
        $user->firstname = $attributes['firstname'] ?? $user->firstname;
        $user->middlename = $attributes['middlename'] ?? $user->middlename;
        $user->lastname = $attributes['lastname'] ?? $user->lastname;
        $user->suffixname = $attributes['suffixname'] ?? $user->suffixname;
        $user->username = $attributes['username'] ?? $user->username;
        $user->email = $attributes['email'] ?? $user->email;
        $user->type = $attributes['type'] ?? $user->type;
        if (isset($attributes['password'])) {
            $user->password = Hash::make($attributes['password']);
        }
        if ($this->request->hasFile('photo')) {
            $user->photo = $this->upload($this->request->photo);
        }
        $user->save();

        return true;
    }

    /**
     * Soft delete model resource.
     *
     * @param  int|array  $id
     * @return void
     */
    public function destroy($id)
    {
        $user = $this->find($id);
        $user->delete();
    }

    /**
     * Include only soft deleted records in the results.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listTrashed()
    {
        return $this->model->onlyTrashed()->latest()->paginate(config('default.pagination.size'));
    }

    /**
     * Restore model resource.
     *
     * @param  int|array  $id
     * @return void
     */
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
    }

    /**
     * Permanently delete model resource.
     *
     * @param  int|array  $id
     * @return void
     */
    public function delete($id)
    {
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
    }

    /**
     * Upload the given file.
     *
     * @return string|null
     */
    public function upload(UploadedFile $file)
    {
        $coverImage = Storage::disk(config('filesystems.default'))->put(config('global.users_images'), $file);

        return config('global.users_images').basename($coverImage);
    }

    public function handleSavingDetails(User $user)
    {
        $keys = DetailKeysEnum::getKeysValues($user);
        $inputs = [];
        foreach ($keys as $key => $value) {
            $inputs[] = [
                'key' => $key,
                'value' => $value,
                'status' => '1',
                'type' => DetailTypeEnum::BIO->value,
                'user_id' => $user->id,
            ];
        }

        return Detail::insert($inputs);
    }
}
