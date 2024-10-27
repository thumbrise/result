<?php

namespace Thumbrise\Result\UseCaseResult\Types;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;
use UnitEnum;

/**
 *  Request not authenticated due to missing, invalid, or expired token.
 *
 *  ExampleErrorMessage - Invalid authentication credentials.
 */
class UseCaseResultUnauthenticated extends UseCaseResult
{
    public function __construct(
        string $message = 'Invalid authentication credentials',
        null|string|UnitEnum $reason = null,
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
        return 'UNAUTHENTICATED';
    }

    protected function httpCode(): int
    {
        return 401;
    }
}
