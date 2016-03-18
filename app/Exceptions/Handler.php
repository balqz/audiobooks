<?php

namespace App\Exceptions;

use App\Utils\ResponseUtil;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof TokenExpiredException) {
            return ResponseUtil::json('',
                'You need to login again',
                'token_expired',
                $e->getStatusCode()
            );
        } else if ($e instanceof TokenInvalidException) {
            return ResponseUtil::json('',
                'You are unauthorized, please login again',
                'token_invalid',
                $e->getStatusCode()
            );
        }

        if (request()->header('Accept') == 'application/json') {
            return ResponseUtil::json(
                '',
                'Oops sorry, something\'s wrong. Please try again later.',
                (string)$e,
                500
            );
        } else {
            return parent::render($request, $e);
        }
    }
}
