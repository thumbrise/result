<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\UseCaseResult;

class UseCaseResultOk extends UseCaseResult
{
    /**
     * Result is success.
     */
    public function __construct(private readonly mixed $output) {}

    public function isError(): bool
    {
        return false;
    }

    protected function output(): mixed
    {
        return $this->output;
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

    protected function httpCode(): int
    {
        return 200;
    }
}
