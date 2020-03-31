<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function respondSuccess()
    {
        return $this->response(null, 204);
    }
}
