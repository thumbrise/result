<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsBadRequest;
use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 *  Client specified an invalid argument.
 *
 *  <code>
 *      new UseCaseResultInvalidArgument(
 *          new ErrorDetailsBadRequest([
 *              'field1' => ['rule1', 'rule2'],
 *              'field2' => ['rule1', 'rule2'],
 *          ])
 *      );
 *  </code>.
 *
 *  <code>
 *      new UseCaseResultInvalidArgument(new ErrorDetailsBadRequest($validator->failed()))
 *  </code>
 */
class UseCaseResultInvalidArgument extends UseCaseResult
{
    public function __construct(
        ErrorDetailsBadRequest $details,
        string $message = 'Invalid argument',
    ) {
        parent::__construct($details, $message);
    }

    public function isError(): bool
    {
        return true;
    }

    protected function errorStatus(): string
    {
        return 'INVALID_ARGUMENT';
    }

    protected function httpCode(): int
    {
        return 422;
    }

    protected function output(): mixed
    {
        return null;
    }
}
