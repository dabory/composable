<?php

namespace App\Exceptions;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Exceptions\ParameterException;
use Throwable;

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

    private function customApiResponse($e): \Illuminate\Http\Response
    {
        $statusCode = $e->getCode();
        $message = $e->getMessage();

        session()->put('previous_url', url()->current());

        switch ($statusCode) {
            case 505:
                session()->flush();
                $proViewPath = 'views.errors.505';
                $view = view()->exists($proViewPath) ? $proViewPath : 'errors.505';
                break;
            case 506:
                $proViewPath = 'views.errors.506';
                $view = view()->exists($proViewPath) ? $proViewPath : 'errors.506';
                break;
            case 503:
                session()->flush();
                $proViewPath = 'views.errors.503';
                $view = view()->exists($proViewPath) ? $proViewPath : 'errors.503';
                break;
            case 600:
                session()->flush();
                $proViewPath = 'views.errors.600';
                $view = view()->exists($proViewPath) ? $proViewPath : 'errors.600';
                break;
            default:
                session()->flush();
                $proViewPath = 'views.errors.etc';
                $view = view()->exists($proViewPath) ? $proViewPath : 'errors.etc';
                break;
        }

        return response()->view($view, [
            'message' => $message,
            'status' => $statusCode,
        ]);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */

    public function register()
    {
        $this->reportable(function (Throwable $e) {

        });

        $this->renderable(function (ApiException $e, $request) {
            return $this->customApiResponse($e);
        });

        $this->renderable(function (ParameterException $e, $request) {
            return response()->view('errors.etc', [
                'message' => 'ParameterException: '.$e->getMessage().
                    ' 경로에 Parameter 형식에 맞춰서 넣어주세요.',
                'status' => '500',
            ]);
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            switch ($exception->getStatusCode()) {
                case 404:
                    $proViewPath = 'views.errors.404';
                    $view = view()->exists($proViewPath) ? $proViewPath : 'errors.404';
                    return response()->view($view, [], 404);
            }
        }

        $previous = $exception->getPrevious();
        if (empty($previous) || ! $previous instanceof ApiException) {
            return parent::render($request, $exception);
        }

        session()->put('previous_url', url()->current());
        $errorCode = $previous->getCode();
        $proViewPath = "views.errors.$errorCode";
        $view = view()->exists($proViewPath) ? $proViewPath : "errors.$errorCode";
        if ($errorCode !== 506) {
            session()->flush();
        }
        return response()->view($view, [], 505);

//        return parent::render($request, $exception);
    }
}
