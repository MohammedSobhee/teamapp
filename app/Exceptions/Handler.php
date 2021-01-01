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
    {

        if ($request->segment(1) == 'api' || $request->ajax()) {
            if ($exception instanceof NotFoundHttpException) {
                return response_api(false, 404, []);
            }
//        if ($exception instanceof \ErrorException || $exception instanceof QueryException) {
//            return response_api(false, 500, []);
//        }
            if ($exception instanceof ModelNotFoundException || $exception instanceof OAuthServerException) {
                return response_api(false, 422, null, []);
            }
        }


        if ($exception instanceof \Illuminate\Validation\ValidationException) {

            $arr = array();
            $errors_data = [];
            $messages = $exception->errors();
            $mainMessage = null;
            foreach ($messages as $key => $row) {
                $errors_data['fieldname'] = $key;
                $errors_data['message'] = $row[0];
                $arr[] = $errors_data;

                if (!isset($mainMessage))
                    $mainMessage = $row[0];
            }

            dd($request->all());
            if (request()->segment(1) == 'password') {
                return redirect()->back()->withErrors($exception);
            }
            return response()->json(['status' => false, 'statusCode' => 422, 'message' => $mainMessage, 'items' => $arr]);
//            return new JsonResponse($exception->errors(), 422);
        }

        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            // Code here ...
            return response()->json([
                'responseMessage' => 'You do not have the required authorization.',
                'responseStatus' => 403,
            ]);
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {

        if ($request->expectsJson() || $request->segment(1) == 'api') {
            return response_api(false, 401, null, []);
        }

        $guard = Arr::get($exception->guards(), 0);

        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            default:
                $login = 'login';
                break;
        }
        return redirect()->guest(route($login));
    }
}
