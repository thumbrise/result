<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\UseCaseResult;

class UseCaseResultAlreadyExists extends UseCaseResult
{
    public function __construct(
        private readonly string $resourceType,
        private readonly string $resourceName,
        private readonly string $owner,
        private readonly string $description
    ) {
        parent::__construct();
    }

    public function isError(): bool
    {
        return true;
    }

    protected function output(): string
    {
        return '';
    }

    protected function errorDetails(): array
    {
        return [
            'resourceType' => $this->resourceType,
            'resourceName' => $this->resourceName,
            'owner'        => $this->owner,
            'description'  => $this->description,
        ];
    }

    protected function errorMessage(): string
    {
        return 'Already exists';
    }

    protected function errorStatus(): string
    {
        return 'ALREADY_EXISTS';
    }

    protected function httpCode(): int
    {
        return 409;
    }
}
