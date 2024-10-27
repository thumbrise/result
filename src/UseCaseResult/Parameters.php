<?php

namespace Thumbrise\Result\UseCaseResult;

use UnitEnum;

class Parameters
{
    /**
     * Arbitrary data which returns if result is success.
     *
     * @var null|mixed
     */
    public mixed $successOutput = null;

    /**
     * Arbitrary data which returns if result is error.
     *
     * @var null|mixed
     */
    public mixed $errorDetails = null;

    /**
     * User faced error message.
     */
    public ?string $errorMessage = 'Something went wrong';

    /**
     * Application level error code.
     */
    public string|UnitEnum $errorReason = 'UNKNOWN';
}
