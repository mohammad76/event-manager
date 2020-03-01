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
            $response['__debug'] = [
                'request' => request()->all(),
                'user'    => auth()->user() ?? 'Guest',
            ];
        }
        return \response()->json($response, $code);
    }


    public function errorResponse($message, $code , $data = NULL)
    {
        $response = [
            'code'    => $code,
            'status'  => 'error',
            'message' => $message,
        ];
        if ($data){
            $response['data'] = $data;
        }
        return \response()->json($response, $code);
    }

}
