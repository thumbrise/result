<?php

namespace Thumbrise\Result\Tests\Laravel\UseCaseResult;

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Thumbrise\Result\Tests\Laravel\TestCase;
use Thumbrise\Result\Tests\Stubs\UseCaseResultStubError;
use Thumbrise\Result\Tests\Stubs\UseCaseResultStubSuccess;
use Thumbrise\Result\UseCaseResult\UseCaseResult;

/**
 * @internal
 */
#[CoversClass(UseCaseResult::class)]
class UseCaseResultTest extends TestCase
{
    #[Test]
    public function basicError()
    {
        Route::get('test', function () {
            return new UseCaseResultStubError();
        });

        $response = $this->get('test');

        $response->assertStatus(403);
        $response->assertJson([
            'error' => [
                'message'  => 'Some error message',
                'category' => 'SOME_ERROR_STATUS',
                'reason'   => 'TEST_REASON',
                'details'  => ['hehe' => 'haha'],
            ],
        ]);
    }

    #[Test]
    public function basicSuccess()
    {
        Route::get('test', function () {
            return new UseCaseResultStubSuccess();
        });

        $response = $this->get('test');

        $response->assertStatus(201);
        $response->assertJson([
            'data' => ['is' => 'ok'],
        ]);
    }

    #[Test]
    public function httpStatusCodeReplaced()
    {
        $status = 409;
        Route::get('test', function () use ($status) {
            $r = new UseCaseResultStubError();

            $r->setStatusCode($status);

            return $r;
        });

        $response = $this->get('test');

        $response->assertStatus($status);
    }

    #[Test]
    public function httpHeaderReplaced()
    {
        $headerKey   = 'X-My-Test-Header';
        $headerValue = 'Super value!';
        Route::get('test', function () use ($headerValue, $headerKey) {
            return (new UseCaseResultStubSuccess())->header($headerKey, $headerValue);
        });

        $response = $this->get('test');

        $response->assertHeader($headerKey, $headerValue);
    }
}
