<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $data
     * @param int $status
     * @param null $message
     * @param array $headers
     * @param null $errors
     * @return JsonResponse
     */
    public function response($data, $status = 200, $message = null, $headers = [], $errors = null)
    {
        return response()->json([
            'message' => $message,
            'status'  => $status,
            'data'    => $data,
            'errors'  => $errors,
        ], $status, $headers);
    }

}
