<?php

namespace App\Services\Admin\Users;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    private const PER_PAGE = 15;
    private const SORT_BY = 'id';
    private const SORT_ORDER = 'asc';
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllUsers(): LengthAwarePaginator
    {
        return User::where('id', '!=', auth()->id())
            ->orderBy(self::SORT_BY, self::SORT_ORDER)
            ->paginate(self::PER_PAGE);
    }

    public function getOne(int $id): User
    {
        return User::query()->findOrFail($id);
    }

    public function create(array $data): void
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::query()->create($data);
        $user->assignRole('admin');
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
