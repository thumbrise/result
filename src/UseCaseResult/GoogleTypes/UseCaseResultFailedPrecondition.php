<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsPreconditionFailure;
use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * Request can not be executed in the current system state, such as deleting a non-empty directory.
 *
 * Resource xxx is a non-empty directory, so it cannot be deleted.
 */
class UseCaseResultFailedPrecondition extends UseCaseResult
{
    public function __construct(
        ErrorDetailsPreconditionFailure $details,
        string $message = 'Failed precondition',
    ) {
        parent::__construct($details, $message);
    }

    public function isError(): bool
    {
        return true;
    }

    protected function errorStatus(): string
    {
        return 'FAILED_PRECONDITION';
    }

    protected function httpCode(): int
    {
        return 400;
    }

    protected function output(): mixed
    {
        return null;
    }
}
