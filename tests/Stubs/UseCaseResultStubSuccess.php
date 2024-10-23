<?php

namespace Thumbrise\Result\Tests\Stubs;

use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * @internal
 */
class UseCaseResultStubSuccess extends UseCaseResult
{
    public function isError(): bool
    {
        return false;
    }

    protected function output(): mixed
    {
        return ['is' => 'ok'];
    }

    protected function errorDetails(): mixed
    {
        return null;
    }

    protected function errorMessage(): string
    {
        return '';
    }

    protected function errorStatus(): string
    {
        return '';
    }

    protected function errorReason(): string
    {
        return '';
    }

    protected function httpCode(): int
    {
        return 201;
    }
}
