<?php

namespace Thumbrise\Result\UseCaseResult;

class Debug
{
    /**
     * Developer faced error message.
     */
    public string $message = '';

    /**
     * Trace. Stack entries. Call trace. Or what needed in case.
     */
    public array $trace = [];

    /**
     * Arbitrary developer faced additional error data.
     */
    public array $metadata = [];
}
