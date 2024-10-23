<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * Result is success.
 */
class UseCaseResultOk extends UseCaseResult
{
    public function __construct(private readonly mixed $output)
    {
        parent::__construct();
    }

    public function isError(): bool
    {
        return false;
    }

    protected function output(): mixed
    {
        return $this->output;
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
