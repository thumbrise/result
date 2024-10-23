<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * API method not implemented by the server.
 *
 * ExampleErrorMessage - Method 'xxx' not implemented.
 */
class UseCaseResultNotImplemented extends UseCaseResult
{
    public function __construct(mixed $errorMessage = 'Not implemented')
    {
        parent::__construct(null, $errorMessage);
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
        return 'NOT_IMPLEMENTED';
    }

    protected function httpCode(): int
    {
        return 501;
    }
}
