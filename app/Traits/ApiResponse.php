<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{

    public function successResponse($data, $code = Response::HTTP_OK, $message = NULL)
    {
        $response = [
            'code'   => $code,
            'status' => 'success',
        ];
        if (!is_null($message)) {
            $response['message'] = $message;
        }
        $response['data'] = $data;
        if (config('app.debug') == TRUE) {
            $response['user'] = auth()->user() ?? 'Guest';
        }
        return \response()->json($response, $code);
    }


    public function errorResponse($message, $code)
    {
        $response = [
            'code'   => $code,
            'status' => 'error',
            'message' => $message
        ];
        return \response()->json($response, $code);
    }

}
