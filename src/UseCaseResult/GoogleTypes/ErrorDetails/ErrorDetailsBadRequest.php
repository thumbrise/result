<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails;

/**
 * BadRequest describes violations in a client request. This error type focuses on the syntactic aspects of the request.
 */
class ErrorDetailsBadRequest
{
    /**
     * @param array<string, array<int, string>> $fieldViolations Dictionary of field key to field violations. Describes all violations in a client request.
     */
    public function __construct(public readonly array $fieldViolations) {}
}
