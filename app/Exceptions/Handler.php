<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;



    use Exception;
    
    
    use Illuminate\Auth\AuthenticationException;
    use Auth; 
    

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        
      
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('/login/admin');
        }
        if ($request->is('manager') || $request->is('manager/*')) {
            return redirect()->guest('/login/manager');
        }
        if ($request->is('receptionist') || $request->is('receptionist/*')) {
            return redirect()->guest('/login/receptionist');
        }
        if ($request->is('client') || $request->is('client/*')) {
            return redirect()->guest('/login/client');
        }
        return redirect()->guest(route('login'));
    }
    

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    

}