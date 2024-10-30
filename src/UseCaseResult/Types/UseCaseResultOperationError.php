<?php

namespace Thumbrise\Result\UseCaseResult\Types;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;
use UnitEnum;

/**
 * Operation error.
 * Operation cannot complete for any internal reason.
 * Caught logic errors for which there was no way to bypass and properly handle the error.
 * Not the same as 500 (INTERNAL). 500 is not caught errors, typically bug.
 *
 * Since the client cannot fix the server error, it is not useful to generate additional error details. To avoid leaking sensitive information under error conditions, it is recommended not to generate any error message. Use withDebug in dev environment.
 */
class UseCaseResultOperationError extends UseCaseResult
{
    public function __construct(
        string $message = 'Operation error',
        string|UnitEnum $reason = 'UNKNOWN',
    ) {
        $parameters               = new Parameters();
        $parameters->errorMessage = $message;
        $parameters->errorReason  = $reason;
        parent::__construct($parameters);
    }

    public function isError(): bool
    {
        return true;
    }

    protected function errorCategory(): string
    {
        return 'OPERATION_ERROR';
    }

    protected function httpCode(): int
    {
        return 503;
    }
}
