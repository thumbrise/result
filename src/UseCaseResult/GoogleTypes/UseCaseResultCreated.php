<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\UseCaseResult;

class UseCaseResultCreated extends UseCaseResult
{
    /**
     * Result is success and new resource created.
     */
    public function __construct(private readonly mixed $details) {}

    public function isError(): bool
    {
        return false;
    }

    protected function output(): mixed
    {
        return $this->details;
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
        return 201;
    }
}
