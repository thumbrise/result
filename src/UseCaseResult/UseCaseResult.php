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
use UnitEnum;

/**
 * @mixin    JsonResponse
 */
abstract class UseCaseResult implements Stringable, JsonSerializable, Responsable
{
    use ForwardsCalls;

    protected JsonResponse $httpResponse;
    private static bool $debugInfoEnabled = false;
    private ?Debug $debug                 = null;

    /**
     * @var null|mixed
     */
    private mixed $meta = null;

    public function __construct(
        private readonly ?Parameters $parameters = null,
    ) {
        $this->httpResponse = new JsonResponse();
        $this->httpResponse->setStatusCode($this->httpCode());
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

    public static function enableDebugInfo(bool $value): void
    {
        self::$debugInfoEnabled = $value;
    }

    /**
     * Decorates vendor\symfony\http-foundation\Response.
     *
     * Sets the response status code.
     *
     * If the status text is null it will be automatically populated for the known
     * status codes and left empty otherwise.
     *
     * @final
     */
    public function setStatusCode(int $code, ?string $text = null): static
    {
        $this->httpResponse->setStatusCode($code, $text);

        return $this;
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
            $result = [
                'error' => [
                    'category' => $this->errorCategory(),
                    'message'  => $this->parameters?->errorMessage                           ?? '',
                    'reason'   => $this->prepareErrorReason($this->parameters?->errorReason) ?? '',
                    'details'  => (array) $this->parameters?->errorDetails                   ?? [],
                ],
            ];

            if (self::$debugInfoEnabled) {
                $result['error']['debug'] = [
                    'message'  => $this->debug?->message  ?? '',
                    'trace'    => $this->debug?->trace    ?? debug_backtrace(~DEBUG_BACKTRACE_PROVIDE_OBJECT),
                    'metadata' => $this->debug?->metadata ?? [],
                ];
            }
        } else {
            $result = [
                'data' => $this->parameters?->successOutput,
            ];
        }

        if (isset($this->meta)) {
            $result['meta'] = $this->meta;
        }

        return $result;
    }

    /**
     * Add context data. Additional meta for needs in specific responses.
     *
     * @return $this
     */
    public function withMeta(mixed $value = null): static
    {
        $this->meta = $value;

        return $this;
    }

    /**
     * Add debug data. Its will shows up if enableDebugInfo(true).
     *
     * @return $this
     */
    public function withDebug(?string $message = null, ?array $trace = null, ?array $metadata = null): static
    {
        $this->debug           = new Debug();
        $this->debug->message  = $message;
        $this->debug->trace    = $trace;
        $this->debug->metadata = $metadata;

        return $this;
    }

    public function toResponse($request): Application|\Illuminate\Foundation\Application|JsonResponse|Response|ResponseFactory
    {
        $this->httpResponse->setJson($this);

        return $this->httpResponse;
    }

    /**
     * String representation of error type category. In example INVALID_ARGUMENT.
     */
    abstract protected function errorCategory(): string;

    /**
     * Number representation of http status.
     */
    abstract protected function httpCode(): int;

    /**
     * @return mixed|string
     */
    private function prepareErrorReason(mixed $code): mixed
    {
        if ($code instanceof UnitEnum) {
            $separator = '/';
            $code      = class_basename($code).$separator.$code->name;
        }

        return $code;
    }
}
