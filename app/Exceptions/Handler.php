<?php

namespace App\Exceptions;

use App\Models\KeyValue;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\View;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception) && $exception->getStatusCode() == 404) {
            $logo = KeyValue::Where('key', 'index_logo')->first();

            $index_icon = KeyValue::Where('key', 'index_icon')->first();
            return response()->view('errors.404', ['logo' => $logo, "index_icon" => $index_icon], 404);
        }

        if (file_exists(storage_path('framework/down'))) {
            // Bakım modunda mı kontrol et
            //if (file_exists(storage_path('framework/down'))) {
            // Özel bir bakım sayfasına yönlendir
            return response()->view('errors.maintenance', [], 503);
            //}
        }

        return parent::render($request, $exception);
    }
}
