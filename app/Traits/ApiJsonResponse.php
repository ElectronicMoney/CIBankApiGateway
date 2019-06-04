<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiJsonResponse
{
    /**
     * Return Success JsonResponse
     *
     * @param  string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK) {
        return response()->json(['data' => $data], $code);
    }

    /**
     * Return Success JsonResponse
     *
     * @param  string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successHeaderWithToken($data, $apiToken, $code = Response::HTTP_OK) {
        return response($data, $code)->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiToken
        ]);
    }

    /**
     * Return Error JsonResponse
     *
     * @param  string  $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code) {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    /**
     * Return Success JsonResponse
     *
     * @param  string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successHeader($data, $code = Response::HTTP_OK) {
        return response($data, $code)->header('Content-Type', 'application/json');
    }

    /**
     * Return Error JsonResponse
     *
     * @param  string  $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorHeader($message, $code) {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

}
