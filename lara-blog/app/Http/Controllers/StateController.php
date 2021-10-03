<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StateController extends Controller
{
    public function sendResponse($msg, $data=[], $error=true, $code=200)
    {
        $response = [
            "success" => $error,
            "message" => $msg,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }
}
