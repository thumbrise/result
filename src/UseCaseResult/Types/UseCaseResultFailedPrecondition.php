<?php

namespace Thumbrise\Result\UseCaseResult\Types;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;
use UnitEnum;

/**
 * Request can not be executed in the current system state, such as deleting a non-empty directory.
 *
 * ExampleErrorMessage - Resource xxx is a non-empty directory, so it cannot be deleted.
 */
class UseCaseResultFailedPrecondition extends UseCaseResult
{
    public function __construct(
        string $message = 'Failed precondition',
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
        return 'FAILED_PRECONDITION';
    }

    protected function httpCode(): int
    {
        return 400;
    }
}
