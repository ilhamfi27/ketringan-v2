<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Ketringan v2 API Documentation",
     *      description="API documentation for Ketringan App v2. Usable for PWA and Android Mobile",
     *      @OA\Contact(
     *           email="ilhamfi_2701@yahoo.com"
     *      )
     * ),
     * @OA\Server(
     *      url="localhost:8000/api/v1",
     *      description="Main development server"
     * )
     */
}
