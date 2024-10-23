<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails;

/**
 * PreconditionFailure describes what preconditions have failed.
 *
 * For example, if an RPC failed because it required the Terms of Service to be acknowledged, it could list the terms of service violation in the PreconditionFailure message.
 */
class ErrorDetailsPreconditionFailure
{
    /**
     * @param array<int, \Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\SubTypes\ErrorDetailsPreconditionFailureViolation> $violations describes all precondition violations
     */
    public function __construct(public readonly array $violations) {}
}
