<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    /**
     *Success response
     *
     *@return JsonResponse
     */

    public function sendSuccess($result, $message = ''){
        $response = [
            'result' => 'ok',
            'details' => $message,
            'data' => $result
        ];
        return response()->json($response, 200);
    }


    /**
     * Error response
     *
     *@return JsonResponse
     */

    public function sendError($error, $messages = [], $code = 404){
        $response = [
            'result' => 'error',
            'details' => $error,
        ];

        if(!empty($messages)){
            $response['data'] = $messages;
        }
        return response()->json($response, $code);
    }
}
