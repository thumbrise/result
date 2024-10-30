<?php

namespace Thumbrise\Result\Tests\Unit\UseCaseResult;

use PHPUnit\Framework\Attributes\Test;
use Thumbrise\Result\Tests\Stubs\StubErrors;
use Thumbrise\Result\Tests\Stubs\UseCaseResultStubError;
use Thumbrise\Result\Tests\Stubs\UseCaseResultStubSuccess;
use Thumbrise\Result\Tests\Unit\TestCase;
use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * @internal
 */
class UseCaseResultTest extends TestCase
{
    #[Test]
    public function debugAdds()
    {
        UseCaseResult::enableDebugInfo(true);

        $debugInfo = ['maybe its will help you' => 'abrakadabra'];

        $result = (new UseCaseResultStubError())
            ->withDebug($debugInfo)
        ;

        $actual = $result->toArray();

        $this->assertNotEmpty($actual['error']['debug']);
        $this->assertEquals($debugInfo, $actual['error']['debug']['info']);
        $this->assertNotEmpty($actual['error']['debug']['trace']);
        $this->assertTrue($result->isError());

        UseCaseResult::enableDebugInfo(false);
    }

    #[Test]
    public function debugNotAddsWithEnableDebugInfoFalse()
    {
        UseCaseResult::enableDebugInfo(false);

        $contextMetadata = ['maybe its will help you' => 'abrakadabra'];

        $result = (new UseCaseResultStubError())
            ->withDebug($contextMetadata)
        ;

        $actual = $result->toArray();

        $this->assertTrue(empty($actual['error']['debug']));
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function reasonAddsEnumNameBasedPrefix()
    {
        $message = 'Some error';
        $reason  = StubErrors::StubError;
        $details = ['s' => 'h'];

        $expected = [
            'error' => [
                'reason'   => 'StubErrors/StubError',
                'message'  => $message,
                'details'  => $details,
                'category' => 'SOME_ERROR_STATUS',
            ],
        ];

        $result = (new UseCaseResultStubError($details, $message, $reason));

        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function metaAddsInError()
    {
        $message = 'Some error';
        $reason  = 'SOME_REASON';
        $details = ['s' => 'h'];

        $meta = ['bla' => ['abl' => 'abab']];

        $expected = [
            'error' => [
                'reason'   => $reason,
                'message'  => $message,
                'details'  => $details,
                'category' => 'SOME_ERROR_STATUS',

                // There no debug data
                // 'debug'  => [
                //     'message'  => $contextMessage,
                //     'trace'    => $contextTrace,
                //     'metadata' => $contextMetadata,
                // ],
            ],
            'meta' => $meta,
        ];

        $result = (new UseCaseResultStubError($details, $message, $reason))
            ->withMeta($meta)
        ;

        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isError());
    }

    #[Test]
    public function metaAddsInSuccess()
    {
        $data = ['Some data' => 'absdhashash'];
        $meta = ['bla' => ['abl' => 'abab']];

        $expected = [
            'data' => $data,
            'meta' => $meta,
        ];

        $result = (new UseCaseResultStubSuccess($data))
            ->withMeta($meta)
        ;

        $actual = $result->toArray();

        $this->assertEquals($expected, $actual);
        $this->assertTrue($result->isSuccess());
    }
}
