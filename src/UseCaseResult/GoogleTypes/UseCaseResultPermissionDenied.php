<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsErrorInfo;
use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 *  Client does not have sufficient permission. This can happen because the OAuth token does not have the right scopes, the client doesn't have permission, or the API has not been enabled.
 *
 *  ExampleErrorMessage - Permission 'xxx' denied on resource 'yyy'.
 */
class UseCaseResultPermissionDenied extends UseCaseResult
{
    public function __construct(
        ErrorDetailsErrorInfo $details,
        string $message = 'Forbidden, permission denied',
    ) {
        parent::__construct($details, $message);
    }

    public function isError(): bool
    {
        return true;
    }

    protected function errorStatus(): string
    {
        return 'PERMISSION_DENIED';
    }

    protected function httpCode(): int
    {
        return 403;
    }

    protected function output(): mixed
    {
        return null;
    }
}
