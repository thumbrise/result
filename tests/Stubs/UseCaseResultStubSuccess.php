<?php

namespace Thumbrise\Result\Tests\Stubs;

use Thumbrise\Result\UseCaseResult\Parameters;
use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * @internal
 */
class UseCaseResultStubSuccess extends UseCaseResult
{
    public function __construct(array $output = ['is' => 'ok'])
    {
        $parameters                = new Parameters();
        $parameters->successOutput = $output;
        parent::__construct($parameters);
    }

    public function isError(): bool
    {
        return false;
    }

    protected function errorCategory(): string
    {
        return '';
    }

    protected function httpCode(): int
    {
        return 201;
    }
}
