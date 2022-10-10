<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * success response method.
     *
     * @param $result
     * @param null $message
     * @param int $status
     * @return JsonResponse
     */
    public function sendResponse($result = null, int $status = ResponseAlias::HTTP_OK, $message = null): JsonResponse
    {
        $response = [
            'data' => $result,
            'message' => $message,
        ];

        return response()
            ->json($response, $status);
    }

    public function sendJsonRequest($method, $url, $body, array $auth = [])
    {
        $client = new Client();
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];
            if ($auth) {
                $headers = $headers +  $auth;
            }
            $res = $client->request($method, $url, [
                'headers' => $headers,
                'body' => json_encode($body)
            ]);
        } catch (ClientException $e) {
            return $this->sendError($e->getMessage(), null, $e->getCode());
        }

        return [
            'success' => true,
            'response' => json_decode($res->getBody()->getContents(), true)
        ];
    }

    /**
     * return error response.
     *
     * @param $error
     * @param array $errorMessages
     * @param int $status
     * @return JsonResponse
     */
    public function sendError($error, array $errorMessages = null, int $status = ResponseAlias::HTTP_BAD_REQUEST): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if ($errorMessages && !empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $status);
    }
}
