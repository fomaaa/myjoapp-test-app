<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Entities\User;
use Modules\Api\Entities\Vehicle;
use Modules\Api\Services\VehicleService;

/**
 * Class VehicleController
 * @package Modules\Api\Http\Controllers
 */
class VehicleController extends Controller
{
    /**
     * @var VehicleService
     */
    protected VehicleService $serivce;

    /**
     * VehicleController constructor.
     * @param VehicleService $service
     */
    public function __construct(VehicleService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      path="/vehicle",
     *      tags={"Vehicle"},
     *      summary="Get list of Vehicle",
     *      description="Returns list of Vehicle",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $list = $this->service->getAll();

        return $this->sendResponse($list);
    }
}
