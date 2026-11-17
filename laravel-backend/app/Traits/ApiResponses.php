<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;

trait ApiResponses
{
    protected function ok($message, $data = [])
    {
        return $this->success($message, $data, 200);
    }

    protected function success($message, $data = [], $statusCode = 200)
    {
        // A paginated resource collection keeps its links and meta on its own
        // response. Resolve it here so wrapping it does not discard pagination.
        if ($data instanceof ResourceCollection) {
            return response()->json([
                ...$data->response()->getData(true),
                'message' => $message,
                'status' => $statusCode,
            ], $statusCode);
        }

        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode,
        ], $statusCode);
    }

    protected function error($message, $statusCode)
    {
        return response()->json([
            'message' => $message,
            'status' => $statusCode,
        ], $statusCode);
    }
}
