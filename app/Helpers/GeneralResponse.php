<?php

if (! function_exists('successResponse')) {
    function successResponse()
    {
        $output = [
            'status' => true,
            'errorcode' => 0,
            'message' => 'success'
        ];
        return response()->json($output, 200);
    }
}

if (! function_exists('getDataResponse')) {
    function getDataResponse($data)
    {
        $output = [
            'status' => true,
            'errorcode' => 0,
            'message' => 'success',
            'data' => $data['data']
        ];
        return response()->json($output, 200);
    }
}