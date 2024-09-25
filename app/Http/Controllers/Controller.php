<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

abstract class Controller
{
    /**
     * @OA\Info(
     *     version="1.0",
     *     title="Juicebox app API documentation",
     * )
     */
    public function index() {}
}
