<?php

namespace App\Exceptions;

use Exception;
use ErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
         if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            return responseJsonError('token_expired');
        } 
        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            return responseJsonError('token_invalid');
        }
        if($exception instanceof NotFoundHttpException) {
            return responseJsonError('url_not_found');
        }
        if($exception instanceof PermissionException) {
            return responseJsonError('permission');
        }
        if($exception instanceof ErrorException){
            return responseJsonError('error_exception');
        }
        if($exception instanceof MethodNotAllowedHttpException){
            return responseJsonError('method_not_allowed');
        }
        return parent::render($request, $exception);
    }
   
}
