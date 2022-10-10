<?php


namespace Modules\Api\Services;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Api\Entities\User;
use Modules\Api\Http\Requests\UserRequest;
use Modules\Api\Interfaces\EntityServiceInterface;

/**
 * Class UserService
 * @package Modules\Api\Services
 */
class UserService implements EntityServiceInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return User::withoutTrashed()->get();
    }

    /**
     * @return Collection
     */
    public function getWithTrashedAll(): Collection
    {
        return User::withTrashed()->get();
    }

    /**
     * @param $request
     * @return User
     */
    public function store($request): User
    {
        return User::create($request->all());
    }

    /**
     * @param $id
     * @return User|null
     */
    public function getOne($id): ?User
    {
        return User::find($id);
    }
}
