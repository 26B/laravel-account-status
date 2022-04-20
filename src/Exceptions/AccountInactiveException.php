<?php

namespace TwentySixB\LaravelAccountStatus\Exceptions;

use Exception;
use Throwable;

class AccountInactiveException extends Exception
{

    /**
     * @inheritDoc
     *
     * @param string $status  The current account status
     * @param string $message
     * @param integer $code
     * @param Throwable|null $previous
     */
    public function __construct(
        protected string $status,
        string $message,
        int $code = 0,
        ? Throwable $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $template = config('account-status.view_name');
        $template = 'account-status::errors.account-status';

        return response()->view(
            $template,
            [
                'exception' => $this,
                'status'    => $this->status,
            ],
            $this->getCode()
        );
    }
}
