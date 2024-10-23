<?php

namespace Thumbrise\Result\Tests\Unit\UseCaseResult\GoogleTypes;

use PHPUnit\Framework\Attributes\Test;
use Thumbrise\Result\Tests\Unit\TestCase;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultAborted;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultAlreadyExists;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultCreated;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultInvalidArgument;
use Thumbrise\Result\UseCaseResult\GoogleTypes\UseCaseResultOk;

/**
 * @internal
 */
class GoogleTypesTest extends TestCase
{
    #[Test]
    public function resultAborted()
    {
        $reason   = 'BAD_GUY';
        $domain   = 'badguy.com';
        $metadata = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];
        $expected = [
            'error' => [
                'code'    => 409,
                'message' => 'Operation aborted',
                'status'  => 'ABORTED',
                'details' => [
                    'reason'   => $reason,
                    'domain'   => $domain,
                    'metadata' => $metadata,
                ],
            ],
        ];

        $result = new UseCaseResultAborted($reason, $domain, $metadata);
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultAlreadyExists()
    {
        $resourceType = 'user';
        $resourceName = 'user/25';
        $owner        = 'god';
        $description  = 'cannot recreate record';
        $expected     = [
            'error' => [
                'code'    => 409,
                'message' => 'Already exists',
                'status'  => 'ALREADY_EXISTS',
                'details' => [
                    'resourceType' => $resourceType,
                    'resourceName' => $resourceName,
                    'owner'        => $owner,
                    'description'  => $description,
                ],
            ],
        ];

        $result = new UseCaseResultAlreadyExists($resourceType, $resourceName, $owner, $description);
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function resultAlreadyCreated()
    {
        $output   = 'ok';
        $expected = [
            'data' => $output,
        ];

        $result = new UseCaseResultCreated($output);
        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isSuccess());
    }

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

        $result = new UseCaseResultInvalidArgument($fieldViolations);
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
}
