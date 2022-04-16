<?php

namespace App\Exceptions;
use App\Helpers\Helper;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */

    protected $code = 'code';
    protected $messages = 'messages';
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {

            if($exception->getMessage()=='Unauthenticated.'){
                return Helper::fail([],$exception->getMessage(),401);
            }

            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                $response[$this->messages] = $exception->errors();
                $response[$this->code] = 400;
            } else {
                $response[$this->messages] = $exception->getMessage();
                if (env('APP_DEBUG', true)) {
                    $response['trace'] = $exception->getTrace();
                }
            }

            if ($response[$this->code] <= 100 || $response[$this->code] >= 600) {
                $response[$this->code] = 500;
            }

            return Helper::fail($exception, isset($response[$this->messages])?$response[$this->messages]:'No MSG',$response[$this->code]);
        }


       $environment = App::environment();
       if($environment !='local'){
           if ($this->isHttpException($exception)) {
               if ($exception->getStatusCode() == 404) {
                   return redirect()->route('404notfound');
               }
           }

           if ($exception instanceof AuthorizationException) {
               return redirect()->route('401unauthorized');
           }

           if ($exception instanceof \ErrorException) {
               return redirect()->route('500error');
           } else {
               return parent::render($request, $exception);
           }
       }

        return parent::render($request, $exception);
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
