<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/03/16
 * Time: 9:44
 */

namespace App\Utils;


use Illuminate\Support\Facades\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthUtils
{

    public static function authenticate()
    {
        if (Request::header('Authorization') == NULL) {
            return NULL;
        }

        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return NULL;
        }

        return $user;
    }

}