<?php


namespace Modules\Api\Repositories;

use Modules\Api\Entities\DrivingList;

/**
 * Class DrivingRepository
 * @package Modules\Api\Repositories
 */
class DrivingRepository
{
    /**
     * @param int $userId
     * @param int $vehicleId
     * @return bool
     */
    public function checkDriving(int $userId, int $vehicleId): bool
    {
        return DrivingList::where(function ($query) use ($userId, $vehicleId) {
            $query->where(['user_id' => $userId])->orWhere(['vehicle_id' => $vehicleId]);
        })
            ->where(['finish_at' => null])
            ->exists();
    }

    /**
     * @param int $userId
     * @param int $vehicleId
     * @return DrivingList
     */
    public function create(int $userId, int $vehicleId): DrivingList
    {
        return DrivingList::create([
            'user_id' => $userId,
            'vehicle_id' => $vehicleId,
            'start_at' => time()
        ]);
    }

    /**
     * @param int $userId
     * @param int $vehicleId
     * @return DrivingList|null
     */
    public function delete(int $userId, int $vehicleId): ?DrivingList
    {
        $driving = $this->getOne($userId,  $vehicleId);

        if ($driving) {
            $driving->update([
                'finish_at' => time()
            ]);
        }

        return $driving;
    }

    /**
     * @param int $userId
     * @param int $vehicleId
     * @return DrivingList|null
     */
    public function getOne(int $userId, int $vehicleId): ?DrivingList
    {
        return DrivingList::where([
            'user_id' => $userId,
            'vehicle_id' => $vehicleId,
            'finish_at' => null
        ])->first();
    }
}
