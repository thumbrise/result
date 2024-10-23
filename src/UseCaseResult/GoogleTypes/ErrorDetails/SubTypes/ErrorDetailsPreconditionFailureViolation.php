<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\SubTypes;

/**
 * PreconditionFailureViolation is message type used to describe a single precondition failure.
 */
class ErrorDetailsPreconditionFailureViolation
{
    /**
     * @param string $type        The type of PreconditionFailure. We recommend using a service-specific enum type to define the supported precondition violation subjects. For example, "TOS" for "Terms of Service violation".
     * @param string $subject     The subject, relative to the type, that failed. For example, "google.com/cloud" relative to the "TOS" type would indicate which terms of service is being referenced.
     * @param string $description A description of how the precondition failed. Developers can use this description to understand how to fix the failure. For example: "Terms of service not accepted".
     */
    public function __construct(
        public readonly string $type,
        public readonly string $subject,
        public readonly string $description,
    ) {}
}
