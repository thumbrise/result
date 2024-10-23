<?php

namespace Thumbrise\Result\Tests\Stubs;

use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * @internal
 */
class UseCaseResultStubError extends UseCaseResult
{
    public function isError(): bool
    {
        return true;
    }

    protected function output(): mixed
    {
        return null;
    }

    protected function errorDetails(): mixed
    {
        return ['hehe' => 'haha'];
    }

    protected function errorMessage(): string
    {
        return 'Some error message';
    }

    protected function errorStatus(): string
    {
        return 'SOME_ERROR_STATUS';
    }

    protected function errorReason(): string
    {
        return 'SOME_ERROR_REASON';
    }

    protected function httpCode(): int
    {
        return 403;
    }
}
