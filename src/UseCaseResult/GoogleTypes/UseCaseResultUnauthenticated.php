<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsErrorInfo;
use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 *  Request not authenticated due to missing, invalid, or expired token.
 *
 *  ExampleErrorMessage - Invalid authentication credentials.
 */
class UseCaseResultUnauthenticated extends UseCaseResult
{
    public function __construct(
        ErrorDetailsErrorInfo $details,
        string $message = 'Invalid authentication credentials',
    ) {
        parent::__construct($details, $message);
    }

    public function isError(): bool
    {
        return true;
    }

    protected function errorStatus(): string
    {
        return 'UNAUTHENTICATED';
    }

    protected function httpCode(): int
    {
        return 401;
    }

    protected function output(): mixed
    {
        return null;
    }
}
