<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExampleService;
use App\Traits\ApiJsonResponse;
use Illuminate\Http\Response;

class ManageExampleServiceController extends Controller
{
    use ApiJsonResponse;

    /**
     * The service to consume the examples micro service
     * @var string
     */
    public $exampleService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ExampleService $exampleService) {
        $this->exampleService = $exampleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return $this->successHeader($this->exampleService->getExamples(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return $this->successHeader($this->exampleService->createExample($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($example) {
        return $this->successHeader($this->exampleService->getExample($example), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $example) {
        return $this->successHeader($this->exampleService->editExample($request->all(), $example), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($example) {
        return $this->successHeader($this->exampleService->deleteExample($example), Response::HTTP_OK);
    }
}
