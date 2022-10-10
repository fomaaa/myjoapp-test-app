<?php


namespace Modules\Api\Services;


use Illuminate\Database\Eloquent\Collection;
use Modules\Api\Entities\DrivingList;
use Modules\Api\Interfaces\DrivingInterface;
use Modules\Api\Repositories\DrivingRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * Class DrivingService
 * @package Modules\Api\Services
 */
class DrivingService implements DrivingInterface
{
    /**
     * @var UserService
     */
    public UserService $userService;
    /**
     * @var VehicleService
     */
    public VehicleService $vehicleService;
    /**
     * @var DrivingRepository
     */
    public DrivingRepository $drivingRepository;

    /**
     * DrivingService constructor.
     * @param UserService $userService
     * @param VehicleService $vehicleService
     */
    public function __construct(UserService $userService, VehicleService $vehicleService, DrivingRepository $drivingRepository)
    {
        $this->userService = $userService;
        $this->vehicleService = $vehicleService;
        $this->drivingRepository = $drivingRepository;
    }

    public function getDrivingList(): array
    {
        $list = DrivingList::get();

        return [
            'result' => $list,
            'status' => ResponseAlias::HTTP_OK,
            'message' => ''
        ];
    }

    /**
     * @param int $userId
     * @param int $vehicleId
     * @return array|null
     */
    public function drive(int $userId, int $vehicleId): ?array
    {
        $user = $this->userService->getOne($userId);

        if ($user === null) {
            return [
                'result' => [],
                'status' => ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'User not found'
            ];
        }

        $vehicle = $this->vehicleService->getOne($vehicleId);
        if ($vehicle === null) {
            return [
                'result' => [],
                'status' => ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Vehicle not found'
            ];
        }

        if ($this->checkIsDriving($userId, $vehicleId)) {
            return [
                'result' => [],
                'status' => ResponseAlias::HTTP_NOT_ACCEPTABLE,
                'message' => 'Vehicle or User are already in use'
            ];
        }

        $driving = $this->startDriving($userId, $vehicleId);

        return [
            'result' => $driving,
            'status' => ResponseAlias::HTTP_OK,
            'message' => 'start driving at ' . date('Y-m-d H:i:s')
        ];
    }

    /**
     * @param int $userId
     * @param int $vehicleId
     * @return bool
     */
    private function checkIsDriving(int $userId, int $vehicleId): bool
    {
        return $this->drivingRepository->checkDriving($userId, $vehicleId);
    }

    /**
     * @param int $userId
     * @param int $vehicleId
     * @return \Modules\Api\Entities\DrivingList
     */
    private function startDriving(int $userId, int $vehicleId)
    {
       return  $this->drivingRepository->create($userId, $vehicleId);
    }

    /**
     * @param int $userId
     * @param int $vehicleId
     * @return array
     */
    public function stop(int $userId, int $vehicleId)
    {
        if ($driving = $this->drivingRepository->delete($userId, $vehicleId)) {

            return [
                'result' => $driving,
                'status' => ResponseAlias::HTTP_OK,
                'message' => 'Stop driving at ' . date('Y-m-d H:i:s')
            ];
        } else {
            return [
                'result' => [],
                'status' => ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'No active driving'
            ];
        }
    }

    public function stopByUser(int $userId)
    {
        // TODO: Implement stopByUser() method.
    }

    public function stopByVehicle(int $vehicleId)
    {
        // TODO: Implement stopByVehicle() method.
    }
}
