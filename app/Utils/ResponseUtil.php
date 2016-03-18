<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/03/16
 * Time: 10:31
 */

namespace App\Utils;


class ResponseUtil
{

    public static function json($data = NULL, $message = '', $error = '', $statusCode = 200)
    {
        return response()->json(array(
            'error' => $error,
            'userMessage' => $message,
            'data' => $data
        ), $statusCode);
    }

}