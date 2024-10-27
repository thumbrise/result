<?php

namespace Thumbrise\Result\UseCaseResult\Types;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;
use UnitEnum;

/**
 * Either out of resource quota or reaching rate limiting.
 *
 * ExampleErrorMessage - Quota limit 'xxx' exceeded.
 */
class UseCaseResultResourceExhausted extends UseCaseResult
{
    /**
     * @param int    $limit   total limit, which already exhausted
     * @param string $resetAt time point, when limit will reset
     */
    public function __construct(
        int $limit,
        string $resetAt,
        string $message = 'Resource exhausted, too many attempts',
        null|string|UnitEnum $reason = null,
    ) {
        $parameters               = new Parameters();
        $parameters->errorMessage = $message;
        $parameters->errorReason  = $reason;
        $parameters->errorDetails = compact('limit', 'resetAt');
        parent::__construct($parameters);
    }

    public function isError(): bool
    {
        return true;
    }

    protected function errorCategory(): string
    {
        return 'RESOURCE_EXHAUSTED';
    }

    protected function httpCode(): int
    {
        return 429;
    }
}
