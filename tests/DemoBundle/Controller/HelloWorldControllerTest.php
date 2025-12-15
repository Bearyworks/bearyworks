<?php

namespace Bearyworks\Tests\DemoBundle\Controller;

use Bearyworks\Tests\App\AppKernel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class HelloWorldControllerTest extends TestCase
{
    private AppKernel $kernel;

    protected function setUp(): void
    {
        $this->kernel = new AppKernel('test', true);
        $this->kernel->boot();
    }

    protected function tearDown(): void
    {
        $this->kernel->shutdown();
    }

    public function testHelloWorldReturnsHelloWorld(): void
    {
        $request = Request::create('/hello', 'GET');
        $response = $this->kernel->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Hello World', $response->getContent());
    }
}
