<?php

namespace App\Exceptions;

use App\Mail\ErrorNotification;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Mail;
use Throwable;

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
            $this->sendErrorEmail($e);
        });
    }

    protected function sendErrorEmail(Throwable $e)
    {
        Mail::to([
            'sidunoleh@gmail.com',
            // 'max@4everstudio.com',
        ])->send(new ErrorNotification($e));
    }
}
