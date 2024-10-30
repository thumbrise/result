<?php

namespace Thumbrise\Result\UseCaseResult\Types;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;
use UnitEnum;

/**
 * Internal server error.
 * Typically, a server bug.
 * Uncaught error.
 * An error that is not caught in the business logic layer.
 *
 * Since the client cannot fix the server error, it is not useful to generate additional error details. To avoid leaking sensitive information under error conditions, it is recommended not to generate any error message. Use withDebug in dev environment.
 */
class UseCaseResultInternal extends UseCaseResult
{
    public function __construct(
        string $message = 'Internal error',
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
        return 'INTERNAL';
    }

    protected function httpCode(): int
    {
        return 500;
    }
}
