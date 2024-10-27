<?php

namespace Thumbrise\Result\UseCaseResult\Types;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * Result is success.
 */
class UseCaseResultOk extends UseCaseResult
{
    public function __construct(private readonly mixed $output)
    {
        $parameters                = new Parameters();
        $parameters->successOutput = $this->output;
        parent::__construct($parameters);
    }

    public function isError(): bool
    {
        return false;
    }

    protected function errorCategory(): string
    {
        return '';
    }

    protected function httpCode(): int
    {
        return 200;
    }
}
