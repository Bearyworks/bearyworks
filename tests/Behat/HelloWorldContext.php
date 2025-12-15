<?php

namespace Bearyworks\Tests\Behat;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

class HelloWorldContext implements Context
{
    private ?Response $response = null;

    public function __construct(
        private KernelInterface $kernel
    ) {
    }

    /**
     * @When I visit the hello world page
     */
    public function iVisitTheHelloWorldPage(): void
    {
        $request = Request::create('/hello', 'GET');
        $this->response = $this->kernel->handle($request);
    }

    /**
     * @Then I should see :text
     */
    public function iShouldSee(string $text): void
    {
        if (!$this->response) {
            throw new \RuntimeException('No response received');
        }

        $content = $this->response->getContent();
        if (!str_contains($content, $text)) {
            throw new \RuntimeException(
                sprintf('Text "%s" not found in response. Got: %s', $text, $content)
            );
        }
    }

    /**
     * @Then the response status code should be :code
     */
    public function theResponseStatusCodeShouldBe(int $code): void
    {
        if (!$this->response) {
            throw new \RuntimeException('No response received');
        }

        $actualCode = $this->response->getStatusCode();
        if ($actualCode !== $code) {
            throw new \RuntimeException(
                sprintf('Expected status code %d, got %d', $code, $actualCode)
            );
        }
    }
}
