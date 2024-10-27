<?php

namespace Thumbrise\Result\UseCaseResult\Types;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;
use UnitEnum;

/**
 *  Client does not have sufficient permission. This can happen because the token does not have the right scopes, the client doesn't have permission.
 *
 *  ExampleErrorMessage - Permission 'xxx' denied on resource 'yyy'.
 */
class UseCaseResultPermissionDenied extends UseCaseResult
{
    public function __construct(
        string $message = 'Forbidden, permission denied',
        string|UnitEnum $reason = 'UNKNOWN',
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
        return 'PERMISSION_DENIED';
    }

    protected function httpCode(): int
    {
        return 403;
    }
}
