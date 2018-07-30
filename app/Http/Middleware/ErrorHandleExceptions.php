<?php

namespace App\Http\Middleware;


use Closure;

class ErrorHandleExceptions
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $response = $next($request);
        if($response->original != null && is_array($response->original) && array_key_exists('error', $response->original)){
            return responseJsonError($response->original["error"]);
        }

        return $response;
    }
}
