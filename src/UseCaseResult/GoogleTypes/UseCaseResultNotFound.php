<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsResourceInfo;
use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * A specified resource is not found.
 *
 * ExampleErrorMessage - Resource 'xxx' not found.
 */
class UseCaseResultNotFound extends UseCaseResult
{
    public function __construct(
        ErrorDetailsResourceInfo $details,
        string $message = 'Not found',
    ) {
        parent::__construct($details, $message);
    }

    public function isError(): bool
    {
        return true;
    }

    protected function output(): string
    {
        return '';
    }

    protected function errorStatus(): string
    {
        return 'NOT_FOUND';
    }

    protected function httpCode(): int
    {
        return 404;
    }
}
