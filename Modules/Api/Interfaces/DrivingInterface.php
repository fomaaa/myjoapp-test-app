<?php


namespace Modules\Api\Interfaces;


interface DrivingInterface
{
    public function drive(int $userId, int $vehicleId);

    public function stop(int $userId, int $vehicleId);

    public function stopByVehicle(int $vehicleId);

    public function stopByUser(int $userId);
}
