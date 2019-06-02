<?php

namespace App\Transformer;

use Illuminate\Http\Response;
use App\Traits\ApiJsonResponse;

class ApiJsonTransformer extends Response
{

    use ApiJsonResponse;

}
