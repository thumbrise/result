<?php

namespace Thumbrise\Result\Tests\Unit\UseCaseResult\GoogleTypes;

use DateTime;
use PHPUnit\Framework\Attributes\Test;
use Thumbrise\Result\Tests\Unit\TestCase;
use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsBadRequest;
use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsDebugInfo;
use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsErrorInfo;
use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsPreconditionFailure;
use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsQuotaFailure;
use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\ErrorDetailsResourceInfo;
use Thumbrise\Result\UseCaseResult\GoogleTypes\ErrorDetails\SubTypes\ErrorDetailsPreconditionFailureViolation;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultFailedPrecondition;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultInternal;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultInvalidArgument;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultNotFound;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultNotImplemented;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultOk;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultPermissionDenied;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultResourceExhausted;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultUnauthenticated;

/**
 * @internal
 */
class GoogleTypesTest extends TestCase
{
    #[Test]
    public function resultInvalidArgument()
    {
        $fieldViolations = [
            'field1' => ['rule1', 'rule2'],
            'field2' => ['rule1', 'rule2'],
        ];
        $expected = [
            'error' => [
                'code'    => 422,
                'message' => 'Invalid argument',
                'status'  => 'INVALID_ARGUMENT',
                'details' => [
                    'fieldViolations' => $fieldViolations,
                ],
            ],
        ];

        $result = new UseCaseResultInvalidArgument(
            new ErrorDetailsBadRequest([
                'field1' => ['rule1', 'rule2'],
                'field2' => ['rule1', 'rule2'],
            ])
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
        $violations = [
            new ErrorDetailsPreconditionFailureViolation('DANG1', 'danger.com', 'something danged1'),
            new ErrorDetailsPreconditionFailureViolation('DANG2', 'danger.com', 'something danged2'),
            new ErrorDetailsPreconditionFailureViolation('DANG3', 'danger.com', 'something danged3'),
        ];
        $expected = [
            'error' => [
                'code'    => 400,
                'message' => 'Failed precondition',
                'status'  => 'FAILED_PRECONDITION',
                'details' => [
                    'violations' => $violations,
                ],
            ],
        ];

        $result = new UseCaseResultFailedPrecondition(
            new ErrorDetailsPreconditionFailure($violations)
        );
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultInternal()
    {
        $stackEntries = [
            'frame3',
            'frame2',
            'frame1',
        ];
        $detail   = 'fix that';
        $expected = [
            'error' => [
                'code'    => 500,
                'message' => 'Internal error',
                'status'  => 'INTERNAL',
                'details' => [
                    'stackEntries' => $stackEntries,
                    'detail'       => $detail,
                ],
            ],
        ];

        $result = new UseCaseResultInternal(
            new ErrorDetailsDebugInfo($detail, $stackEntries)
        );
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultNotFound()
    {
        $resourceType = 'user';
        $resourceName = 'user/25';
        $owner        = 'god';
        $description  = 'cannot recreate record';
        $expected     = [
            'error' => [
                'code'    => 404,
                'message' => 'Not found',
                'status'  => 'NOT_FOUND',
                'details' => [
                    'resourceType' => $resourceType,
                    'resourceName' => $resourceName,
                    'owner'        => $owner,
                    'description'  => $description,
                ],
            ],
        ];

        $result = new UseCaseResultNotFound(
            new ErrorDetailsResourceInfo($description, $resourceName, $resourceType, $owner)
        );
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultNotImplemented()
    {
        $expected = [
            'error' => [
                'code'    => 501,
                'message' => 'Not implemented',
                'status'  => 'NOT_IMPLEMENTED',
                'details' => [],
            ],
        ];

        $result = new UseCaseResultNotImplemented();
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultPermissionDenied()
    {
        $reason   = 'BAD_GUY';
        $domain   = 'badguy.com';
        $metadata = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];
        $expected = [
            'error' => [
                'code'    => 403,
                'message' => 'Forbidden - permission denied',
                'status'  => 'PERMISSION_DENIED',
                'details' => [
                    'reason'   => $reason,
                    'domain'   => $domain,
                    'metadata' => $metadata,
                ],
            ],
        ];

        $result = new UseCaseResultPermissionDenied(
            new ErrorDetailsErrorInfo($reason, $domain, $metadata)
        );
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultResourceExhausted()
    {
        $limit    = 5;
        $resetAt  = (new DateTime('+1 hour'))->format(DATE_ATOM);
        $expected = [
            'error' => [
                'code'    => 429,
                'message' => 'Resource exhausted',
                'status'  => 'RESOURCE_EXHAUSTED',
                'details' => [
                    'limit'   => $limit,
                    'resetAt' => $resetAt,
                ],
            ],
        ];

        $details = new ErrorDetailsQuotaFailure($limit, $resetAt);
        $result  = new UseCaseResultResourceExhausted($details);
        $actual  = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultUnauthenticated()
    {
        $reason   = 'BAD_GUY';
        $domain   = 'badguy.com';
        $metadata = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];
        $expected = [
            'error' => [
                'code'    => 401,
                'message' => 'Unauthenticated',
                'status'  => 'UNAUTHENTICATED',
                'details' => [
                    'reason'   => $reason,
                    'domain'   => $domain,
                    'metadata' => $metadata,
                ],
            ],
        ];

        $result = new UseCaseResultUnauthenticated(
            new ErrorDetailsErrorInfo($reason, $domain, $metadata)
        );
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }
}
