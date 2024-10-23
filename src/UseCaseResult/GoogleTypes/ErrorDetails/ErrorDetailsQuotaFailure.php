<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails;

/**
 * QuotaFailure describes how a quota check failed.
 *
 * For example if a daily limit was exceeded for the calling project, a service could respond with a QuotaFailure detail containing the project id and the description of the quota limit that was exceeded. If the calling project hasn't enabled the service in the developer console, then a service could respond with the project id and set `service_disabled` to true.
 * Also see RetryInfo and Help types for other details about handling a quota failure.
 */
class ErrorDetailsQuotaFailure
{
    public function __construct(
        public readonly int $limit,
        public readonly string $resetAt
    ) {}
}
