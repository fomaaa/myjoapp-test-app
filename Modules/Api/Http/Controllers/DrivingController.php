<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Http\Requests\DrivingRequest;
use Modules\Api\Services\DrivingService;
use Modules\Api\Services\VehicleService;

/**
 * Class DrivingController
 * @package Modules\Api\Http\Controllers
 */
class DrivingController extends Controller
{
    /**
     * @var DrivingService
     */
    protected DrivingService $service;

    /**
     * DrivingController constructor.
     * @param DrivingService $service
     */
    public function __construct(DrivingService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      path="/drive-list",
     *      tags={"Drive"},
     *
     *      summary="Driving list",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(): \Illuminate\Http\JsonResponse
    {
        $response = $this->service->getDrivingList();

        return $this->sendResponse($response['result'], $response['status'], $response['message']);
    }

    /**
     * @OA\Post(
     *      path="/drive",
     *      tags={"Drive"},
     *
     *      summary="Start driving vehicle by user",
     *   @OA\Parameter(
     *     description="user_id",
     *     in="query",
     *     name="user_id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Parameter(
     *     description="vehicle_id",
     *     in="query",
     *     name="vehicle_id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="user or vehicle not found"
     *      ),
     *     *      @OA\Response(
     *          response=406,
     *          description="user or vehicle are already in used"
     *      ),
     *     )
     *
     * @param DrivingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function drive(DrivingRequest $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->service->drive($request->user_id, $request->vehicle_id);

        return $this->sendResponse($response['result'], $response['status'], $response['message']);
    }

    /**
     * @param DrivingRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Post(
     *      path="/stop",
     *      tags={"Drive"},
     *
     *      summary="Srop driving vehicle by user",
     *   @OA\Parameter(
     *     description="user_id",
     *     in="query",
     *     name="user_id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Parameter(
     *     description="vehicle_id",
     *     in="query",
     *     name="vehicle_id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation, driving stop",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="no active driving"
     *      )
     *     )
     *
     */
    public function stop(DrivingRequest $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->service->stop($request->user_id, $request->vehicle_id);

        return $this->sendResponse($response['result'], $response['status'], $response['message']);
    }
}
