<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {/*
        if ($exception instanceof NotFoundHttpException) {
            if ($request->segment(1) == 'api')
                return response_api(false, 404, $exception->getMessage(), new \stdClass());
            return redirect()->to(admin_vw() . '/home');
        }
        if ($exception instanceof QueryException) {
            if ($request->segment(1) == 'api')
                return response_api(false, 500, $exception->getMessage(), new \stdClass());
            return redirect()->to(admin_vw() . '/home');
        }

        if ($exception instanceof ModelNotFoundException || $exception instanceof OAuthServerException) {
            return response_api(false, 422, $exception->getMessage(), new \stdClass());
        }
*/
//        if ($exception instanceof HttpException || $exception instanceof AuthenticationException) {
//            if ($request->segment(1) == 'api' || $request->ajax())
//                return response_api(false, 401, trans('app.unauthorized'), new \stdClass());
//            return redirect()->to(admin_vw().'/login');
//        }
        return parent::render($request, $exception);

    }
}
