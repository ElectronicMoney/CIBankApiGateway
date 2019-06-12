<?php

namespace App\Services\CustomerService;

use App\Traits\ApiHttpClient;

class  Customer
{
    use ApiHttpClient;

    /**
     * The baseUri to consume the customers service
     * @var string
     */
    public $baseUri;
    public $apiGatewayPublicAccessToken;
    public $requestHeader;

    /**
     * Creating a new Customer instance.
     *
     * @return void
     */
    public function __construct() {
        $this->baseUri = config('services.customer_service.base_uri');
        $this->apiGatewayPublicAccessToken = config('services.api_public_access_token');

        $this->requestHeader = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $this->apiGatewayPublicAccessToken,
        ];
    }

    /**
     * Fetching the list of customers from the Customer Service
     * @param void
     * @return string
     */
    public function getCustomers() {
        return $this->httpRequest('GET', 'customers', [], $this->requestHeader)->getBody();
    }

    /**
     * creating an customer from customers micro service
     * @param array $data
     * @return string
     */
    public function createCustomer($data) {
        return $this->httpRequest('POST', 'customers', $data, $this->requestHeader)->getBody();
    }

    /**
     * Fetching an customer instance from customers micro service
     * @param int $customerId
     * @return string
     */
    public function getCustomer($customerId) {
        return $this->httpRequest('GET', "customers/{$customerId}", [], $this->requestHeader)->getBody();
    }

    /**
     * updating an customer instance using customers micro service
     * @param array $data
     * @param int $customerId
     * @return string
     */
    public function editCustomer($data, $customerId) {
        return $data;
        return $this->httpRequest('PUT', "customers/{$customerId}", $data, $this->requestHeader)->getBody();
    }

    /**
     * Deleting an customer instance from customers micro service
     * @param int $customerId
     * @return string
     */
    public function deleteCustomer($customerId) {
        return $this->httpRequest('DELETE', "customers/{$customerId}", [], $this->requestHeader)->getBody();
    }
}
