<?php

namespace App\Services;

use App\Traits\ApiHttpClient;

class  ExampleService
{

    use ApiHttpClient;

    /**
     * The baseUri to consume the authors service
     * @var string
     */
    public $baseUri;

    // public;
    /**
     * Creating a new Example instance.
     *
     * @return void
     */
    public function __construct() {
        $this->baseUri = config('services.examples.base_uri');
    }

}
