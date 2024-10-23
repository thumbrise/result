<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\UseCaseResult;

class UseCaseResultCancelled extends UseCaseResult
{
    public function isError(): bool
    {
        return true;
    }

    protected function output(): string
    {
        return '';
    }

    protected function errorDetails(): mixed
    {
        return null;
    }

    protected function errorMessage(): string
    {
        return 'Cancelled';
    }

    protected function errorStatus(): string
    {
        return 'CANCELLED';
    }

    protected function httpCode(): int
    {
        return 499;
    }
}
