<?php

namespace Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails;

/**
 * ResourceInfo describes the resource that is being accessed.
 */
class ErrorDetailsResourceInfo
{
    /**
     * @param string $description  Describes what error is encountered when accessing this resource. For example, updating a cloud project may require the `writer` permission on the developer console project.
     * @param string $resourceName The name of the resource being accessed. For example, a shared calendar name: "example.com_4fghdhgsrgh@group.calendar.google. com", if the current error is [google.rpc.Code.PERMISSION_DENIED][google.rpc.Code.PERMISSION_DENIED].
     * @param string $resourceType A name for the type of resource being accessed, e.g. "sql table", "cloud storage bucket", "file", "Google calendar"; or the type URL of the resource: e.g. "type.googleapis.com/google.pubsub.v1.Topic".
     * @param string $owner        The owner of the resource (optional). For example, "user:<owner email>" or "project:<Google developer project id>".
     */
    public function __construct(
        public readonly string $description,
        public readonly string $resourceName,
        public readonly string $resourceType,
        public readonly string $owner,
    ) {}
}
