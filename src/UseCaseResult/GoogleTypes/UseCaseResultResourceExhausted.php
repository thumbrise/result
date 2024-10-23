<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsQuotaFailure;
use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * Either out of resource quota or reaching rate limiting. The client should look for google.rpc.QuotaFailure error detail for more information.
 *
 * ExampleErrorMessage - Quota limit 'xxx' exceeded.
 */
class UseCaseResultResourceExhausted extends UseCaseResult
{
    public function __construct(
        ErrorDetailsQuotaFailure $details,
        string $message = 'Resource exhausted, too many attempts',
    ) {
        parent::__construct($details, $message);
    }

    public function isError(): bool
    {
        return true;
    }

    protected function errorStatus(): string
    {
        return 'RESOURCE_EXHAUSTED';
    }

    protected function httpCode(): int
    {
        return 429;
    }

    protected function output(): mixed
    {
        return null;
    }
}
