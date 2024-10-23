<?php

namespace Thumbrise\Result\Tests\Stubs;

use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * @internal
 */
class UseCaseResultStubError extends UseCaseResult
{
    public function __construct()
    {
        parent::__construct(['hehe' => 'haha'], 'Some error message');
    }

    public function isError(): bool
    {
        return true;
    }

    protected function output(): mixed
    {
        return null;
    }

    protected function errorStatus(): string
    {
        return 'SOME_ERROR_STATUS';
    }

    protected function httpCode(): int
    {
        return 403;
    }
}
