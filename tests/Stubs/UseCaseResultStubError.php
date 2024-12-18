<?php

namespace Thumbrise\Result\Tests\Stubs;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;
use UnitEnum;

/**
 * @internal
 */
class UseCaseResultStubError extends UseCaseResult
{
    public function __construct(
        array $details = ['hehe' => 'haha'],
        string $message = 'Some error message',
        null|string|UnitEnum $reason = 'TEST_REASON',
    ) {
        $parameters               = new Parameters();
        $parameters->errorMessage = $message;
        $parameters->errorReason  = $reason;
        $parameters->errorDetails = $details;
        parent::__construct($parameters);
    }

    public function isError(): bool
    {
        return true;
    }

    protected function errorCategory(): string
    {
        return 'SOME_ERROR_STATUS';
    }

    protected function httpCode(): int
    {
        return 403;
    }
}
