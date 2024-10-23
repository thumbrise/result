<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\UseCaseResult;

class UseCaseResultInvalidArgument extends UseCaseResult
{
    /**
     * Client specified an invalid argument.
     *
     * <code>
     *     new UseCaseResultInvalidArgument([
     *          'field1' => ['something wrong 1', 'something wrong 2'],
     *          'field2' => ['something wrong 1', 'something wrong 2'],
     *     ])
     * </code>.
     *
     * <code>
     *     new UseCaseResultInvalidArgument($validator->failed())
     * </code>
     *
     * @param array<string, array<int,string>> $fieldViolations Dictionary of field key to field violations. Describes all violations in a client request.
     */
    public function __construct(private readonly array $fieldViolations)
    {
        parent::__construct();
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

    protected function errorDetails(): array
    {
        return $this->fieldViolations;
    }

    protected function errorMessage(): string
    {
        return 'Invalid argument';
    }
}
