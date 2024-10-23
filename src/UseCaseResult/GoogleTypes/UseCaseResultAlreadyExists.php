<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes;

use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * The resource that a client tried to create already exists.
 *
 * ExampleErrorMessage - Resource 'xxx' already exists.
 */
class UseCaseResultAlreadyExists extends UseCaseResult
{
    /**
     * @param string $resourceType A name for the type of resource being accessed, e.g. "sql table", "cloud storage bucket", "file", "Google calendar"; or the type URL of the resource: e.g. "type. googleapis. com/ google. pubsub. v1.Topic".
     * @param string $resourceName The name of the resource being accessed. For example, a shared calendar name: "example. com_4fghdhgsrgh@group. calendar. google. com", if the current error is [google. rpc. Code. PERMISSION_DENIED][google. rpc. Code. PERMISSION_DENIED].
     * @param string $owner        The owner of the resource (optional). For example, "user:<owner email>" or "project:<Google developer project id>".
     * @param string $description  Describes what error is encountered when accessing this resource. For example, updating a cloud project may require the `writer` permission on the developer console project.
     */
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
