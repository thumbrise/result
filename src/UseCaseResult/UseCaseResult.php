<?php

namespace Thumbrise\Result\UseCaseResult;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Traits\ForwardsCalls;
use JsonSerializable;
use Stringable;

/**
 * @template T
 *
 * @mixin    JsonResponse
 */
abstract class UseCaseResult implements Stringable, JsonSerializable, Responsable
{
    use ForwardsCalls;

    protected JsonResponse $httpResponse;

    public function __construct()
    {
        $this->httpResponse = new JsonResponse();
        $this->httpResponse->setStatusCode($this->httpCode());
        $this->httpResponse->setJson($this);
    }

    /**
     * @param mixed $method
     * @param mixed $parameters
     *
     * @throws Exception
     */
    public function __call(string $method, array $parameters)
    {
        return $this->forwardDecoratedCallTo($this->httpResponse, $method, $parameters);
    }

    public function __toString(): string
    {
        return json_encode($this);
    }

    /**
     * Sets the response status code.
     *
     * If the status text is null it will be automatically populated for the known
     * status codes and left empty otherwise.
     *
     * @final
     */
    public function setStatusCode(int $code, ?string $text = null): JsonResponse
    {
        $result = $this->httpResponse->setStatusCode($code, $text);
        $this->httpResponse->setJson($this);

        return $result;
    }

    abstract public function isError(): bool;

    public function isSuccess(): bool
    {
        return ! $this->isError();
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        if ($this->isError()) {
            return [
                'error' => [
                    'code'    => $this->httpResponse->getStatusCode(),
                    'message' => $this->errorMessage(),
                    'status'  => $this->errorStatus(),
                    'details' => $this->errorDetails(),
                ],
            ];
        }

        return [
            'data' => $this->output(),
        ];
    }

    public function toResponse($request): Application|\Illuminate\Foundation\Application|JsonResponse|Response|ResponseFactory
    {
        return $this->httpResponse;
    }

    /**
     * Arbitrary data which returns if result is success.
     */
    abstract protected function output(): mixed;

    /**
     * Arbitrary error details. Any info.
     */
    abstract protected function errorDetails(): mixed;

    /**
     * Arbitrary error description. In example 'Something was wrong'.
     */
    abstract protected function errorMessage(): string;

    /**
     * String representation of error type category. In example INVALID_ARGUMENT.
     */
    abstract protected function errorStatus(): string;

    /**
     * Number representation of http status.
     */
    abstract protected function httpCode(): int;
}
