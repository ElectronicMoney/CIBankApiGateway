<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ApiHttpClient
{
    /**
     * Send a request to any service
     *
     * @param  string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function httpRequest($method, $requestUrl, $formParams = [], $headers = []) {
        //Instantiate the GazzleHttp Client
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);
        //Send the request
        $response = $client->request($method, $requestUrl, ['form_params' => $formParams, 'headers' => $headers]);
        //Return a response
        return $response;
    }
}
