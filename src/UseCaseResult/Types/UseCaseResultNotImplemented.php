<?php

namespace Thumbrise\Result\UseCaseResult\Types;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;
use UnitEnum;

/**
 * API method not implemented by the server.
 *
 * ExampleErrorMessage - Method 'xxx' not implemented.
 */
class UseCaseResultNotImplemented extends UseCaseResult
{
    public function __construct(
        string $message = 'Not implemented',
        null|string|UnitEnum $reason = null,
    ) {
        $parameters               = new Parameters();
        $parameters->errorMessage = $message;
        $parameters->errorReason  = $reason;
        parent::__construct($parameters);
    }

    public function isError(): bool
    {
        return true;
    }

    protected function errorCategory(): string
    {
        return 'NOT_IMPLEMENTED';
    }

    protected function httpCode(): int
    {
        return 501;
    }
}
