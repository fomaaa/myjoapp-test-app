<?php

namespace Modules\Api\Http\Controllers;

use http\Client\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Entities\User;
use Modules\Api\Http\Requests\UserRequest;
use Modules\Api\Services\UserService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Laravel OpenApi TEST Project Documentation",
 *      description="Bortsov Ilia 2022",
 *      @OA\Contact(
 *          email="ibortsov-dev@yandex.ru"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 */

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $serivce;

    /**
     * UserController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    /**
     * @OA\Get(
     *      path="/user",
     *      tags={"User"},
     *      summary="Get list of users",
     *      description="Returns list of users",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
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
