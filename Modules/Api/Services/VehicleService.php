<?php


namespace Modules\Api\Services;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Api\Entities\User;
use Modules\Api\Entities\Vehicle;
use Modules\Api\Http\Requests\VehicleRequest;
use Modules\Api\Interfaces\EntityServiceInterface;

/**
 * Class VehicleService
 * @package Modules\Api\Services
 */
class VehicleService implements EntityServiceInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Vehicle::withoutTrashed()->get();
    }

    /**
     * @param $id
     * @return Vehicle|null
     */
    public function getOne($id): ?Vehicle
    {
        return Vehicle::find($id);
    }

    /**
     * @return Collection
     */
    public function getWithTrashedAll(): Collection
    {
        return Vehicle::withTrashed()->get();
    }

    /**
     * @param $request
     * @return Vehicle
     */
    public function store($request): Vehicle
    {
        return Vehicle::create($request->all());
    }
}
