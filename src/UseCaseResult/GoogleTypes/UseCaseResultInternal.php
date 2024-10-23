<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsDebugInfo;
use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * Internal server error. Typically, a server bug.
 *
 * Since the client cannot fix the server error, it is not useful to generate additional error details. To avoid leaking sensitive information under error conditions, it is recommended not to generate any error message and only generate google.rpc.DebugInfo error details. The DebugInfo is specially designed only for server-side logging, and must not be sent to client.
 */
class UseCaseResultInternal extends UseCaseResult
{
    public function __construct(
        ErrorDetailsDebugInfo $details,
        string $message = 'Internal error',
    ) {
        parent::__construct($details, $message);
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
        return 'INTERNAL';
    }

    protected function httpCode(): int
    {
        return 500;
    }
}
