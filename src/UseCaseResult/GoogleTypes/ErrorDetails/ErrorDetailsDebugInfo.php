<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails;

/**
 * DebugInfo describes additional debugging info.
 */
class ErrorDetailsDebugInfo
{
    /**
     * @param string             $detail       additional debugging information provided by the server
     * @param array<int, string> $stackEntries the stack trace entries indicating where the error occurred
     */
    public function __construct(
        public readonly string $detail,
        public readonly array $stackEntries,
    ) {}
}
