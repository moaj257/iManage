<?php

namespace App\Traits;

trait ApiResponser {
    public function send($msg = null, $data = [], $code = 200) {
        return response()->json(array_merge([
            'status' => ($code < 300 && $code >= 200) ? 'success' : 'error',
            'message' => $msg
        ], $data), $code);
    }
}