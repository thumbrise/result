<?php

namespace Thumbrise\Result\Tests\Laravel;

/**
 * @internal
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getBasePath()
    {
        return realpath(__DIR__.'/Skeleton');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
        $app['config']->set('app.env', 'testing');
        $app['config']->set('app.debug', true);
    }
}
