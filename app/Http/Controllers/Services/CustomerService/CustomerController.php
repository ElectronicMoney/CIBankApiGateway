<?php

namespace App\Http\Controllers\Services\CustomerService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CustomerService\Customer;
use App\Traits\ApiJsonResponse;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    use ApiJsonResponse;

    /**
     * The service to consume the customers micro service
     * @var string
     */
    public $customerService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Customer $customer) {
        $this->customerService = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return $this->successHeader($this->customerService->getCustomers(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return $this->successHeader($this->customerService->createCustomer($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($customer) {
        return $this->successHeader($this->customerService->getCustomer($customer), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customer) {
        return $this->successHeader($this->customerService->editCustomer($request->all(), $customer), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($customer) {
        return $this->successHeader($this->customerService->deleteCustomer($customer), Response::HTTP_OK);
    }
}
