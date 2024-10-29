<?php

namespace Thumbrise\Result\Tests\Unit\UseCaseResult\Types;

use DateTime;
use PHPUnit\Framework\Attributes\Test;
use Thumbrise\Result\Tests\Unit\TestCase;
use Thumbrise\Result\UseCaseResult\Types\UseCaseResultFailedPrecondition;
use Thumbrise\Result\UseCaseResult\Types\UseCaseResultInvalidArgument;
use Thumbrise\Result\UseCaseResult\Types\UseCaseResultNotFound;
use Thumbrise\Result\UseCaseResult\Types\UseCaseResultNotImplemented;
use Thumbrise\Result\UseCaseResult\Types\UseCaseResultOk;
use Thumbrise\Result\UseCaseResult\Types\UseCaseResultPermissionDenied;
use Thumbrise\Result\UseCaseResult\Types\UseCaseResultResourceExhausted;
use Thumbrise\Result\UseCaseResult\Types\UseCaseResultUnauthenticated;

/**
 * @internal
 */
class TypesTest extends TestCase
{
    #[Test]
    public function resultInvalidArgument()
    {
        $fieldViolations = [
            'field1' => ['rule1', 'rule2'],
            'field2' => ['rule1', 'rule2'],
        ];
        $message  = 'Some error';
        $reason   = 'SOME_REASON';
        $expected = [
            'error' => [
                'reason'   => $reason,
                'category' => 'INVALID_ARGUMENT',
                'message'  => $message,
                'details'  => $fieldViolations,
            ],
        ];

        $result = new UseCaseResultInvalidArgument(
            $fieldViolations,
            $message,
            $reason,
        );
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultOk()
    {
        $output   = 'ok';
        $expected = [
            'data' => $output,
        ];

        $result = new UseCaseResultOk($output);
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isSuccess());
    }

    #[Test]
    public function resultFailedPrecondition()
    {
        $message  = 'Some error';
        $reason   = 'SOME_REASON';
        $expected = [
            'error' => [
                'reason'   => $reason,
                'message'  => $message,
                'details'  => [],
                'category' => 'FAILED_PRECONDITION',
            ],
        ];

        $result = new UseCaseResultFailedPrecondition(
            $message,
            $reason
        );
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultNotFound()
    {
        $message  = 'Some error';
        $reason   = 'SOME_REASON';
        $expected = [
            'error' => [
                'reason'   => $reason,
                'message'  => $message,
                'details'  => [],
                'category' => 'NOT_FOUND',
            ],
        ];

        $result = new UseCaseResultNotFound($message, $reason);
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultNotImplemented()
    {
        $message  = 'Some error';
        $reason   = 'SOME_REASON';
        $expected = [
            'error' => [
                'reason'   => $reason,
                'message'  => $message,
                'details'  => [],
                'category' => 'NOT_IMPLEMENTED',
            ],
        ];

        $result = new UseCaseResultNotImplemented($message, $reason);
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultPermissionDenied()
    {
        $message  = 'Some error';
        $reason   = 'SOME_REASON';
        $expected = [
            'error' => [
                'reason'   => $reason,
                'message'  => $message,
                'details'  => [],
                'category' => 'PERMISSION_DENIED',
            ],
        ];

        $result = new UseCaseResultPermissionDenied($message, $reason);
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultResourceExhausted()
    {
        $message  = 'Some error';
        $reason   = 'SOME_REASON';
        $limit    = 5;
        $resetAt  = (new DateTime('+1 hour'))->format(DATE_ATOM);
        $expected = [
            'error' => [
                'reason'  => $reason,
                'message' => $message,
                'details' => [
                    'limit'   => $limit,
                    'resetAt' => $resetAt,
                ],
                'category' => 'RESOURCE_EXHAUSTED',
            ],
        ];

        $result = new UseCaseResultResourceExhausted($limit, $resetAt, $message, $reason);
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultUnauthenticated()
    {
        $message  = 'Some error';
        $reason   = 'SOME_REASON';
        $expected = [
            'error' => [
                'reason'   => $reason,
                'message'  => $message,
                'details'  => [],
                'category' => 'UNAUTHENTICATED',
            ],
        ];

        $result = new UseCaseResultUnauthenticated($message, $reason);
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }
}
