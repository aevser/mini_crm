<?php

namespace App\Services\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getOne(int $id): User
    {
        return User::query()->findOrFail($id);
    }

    public function create(array $data): void
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::query()->create($data);
        $user->assignRole('manager');
    }

    public function update(array $data, int $id): void
    {
        $this->getOne($id)->update($data);
    }

    public function delete(int $id): void
    {
        $this->getOne($id)->delete();
    }
}
