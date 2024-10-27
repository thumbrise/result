<?php

namespace Thumbrise\Result\UseCaseResult\Types;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;
use UnitEnum;

/**
 * A specified resource is not found.
 *
 * ExampleErrorMessage - Resource 'xxx' not found.
 */
class UseCaseResultNotFound extends UseCaseResult
{
    public function __construct(
        string $message = 'Not found',
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
        return 'NOT_FOUND';
    }

    protected function httpCode(): int
    {
        return 404;
    }
}
