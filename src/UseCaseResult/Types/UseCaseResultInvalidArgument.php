<?php

namespace Thumbrise\Result\UseCaseResult\Types;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;
use UnitEnum;

/**
 *  Client specified an invalid argument.
 *
 *  <code>
 *      new UseCaseResultInvalidArgument([
 *              'field1' => ['rule1', 'rule2'],
 *              'field2' => ['rule1', 'rule2'],
 *          ],
 *          'Invalid argument',
 *          SomeModuleErrorsEnum::SomeReason,
 *      );
 *  </code>.
 *
 *  <code>
 *      new UseCaseResultInvalidArgument($validator->errors()->toArray())
 *  </code>
 */
class UseCaseResultInvalidArgument extends UseCaseResult
{
    /**
     * @param array<string, array<int, string>> $fieldViolations Dictionary of field key to field violations. Describes all violations in a client request.
     */
    public function __construct(
        array $fieldViolations,
        string $message = 'Invalid argument',
        string|UnitEnum $reason = 'UNKNOWN',
    ) {
        $parameters               = new Parameters();
        $parameters->errorMessage = $message;
        $parameters->errorReason  = $reason;
        $parameters->errorDetails = $fieldViolations;
        parent::__construct($parameters);
    }

    public function isError(): bool
    {
        return true;
    }

    protected function errorCategory(): string
    {
        return 'INVALID_ARGUMENT';
    }

    protected function httpCode(): int
    {
        return 422;
    }
}
