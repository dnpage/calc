<?php

namespace Tests\Functional;

class HomepageTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'Home Controller'
     */
    public function testGetHomepage()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Home Controller', (string)$response->getBody());
    }

    /**
     * Test that the index route with optional name argument returns a rendered greeting
     */
    public function testGetMissingPage()
    {
        $response = $this->runApp('GET', '/name');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Page Not Found', (string)$response->getBody());
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostHomepageNotAllowed()
    {
        $response = $this->runApp('POST', '/', ['test']);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }

    /**
     * Test that the calc route returns 400 when no calc parameters are passed
     */
    public function testGetCalcPageWithNoParameters()
    {
        $response = $this->runApp('GET', '/calc');

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains('errors', (string)$response->getBody());
    }


    /**
     * Test that the calc route returns 400 when some calc parameters are missing
     */
    public function testGetCalcPageWithMissingParameters()
    {
        $response = $this->runApp('GET', '/calc?a=1&b=1&c=1');

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains('errors', (string)$response->getBody());
    }


    /**
     * Test that the calc route returns 400 when some calc parameters are missing
     */
    public function testGetCalcPageWithValidParameters()
    {
        $response = $this->runApp('GET', '/calc?a=true&b=true&c=true&d=2&e=3&f=4');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('"status":"success"', (string)$response->getBody());
    }

    /**
     * Test that the calc route returns 400 when some calc parameters are missing
     */
    public function testGetCalcPageWithValidParametersButErrorInCalculation()
    {
        $response = $this->runApp('GET', '/calc?a=0&b=0&c=0&d=2&e=3&f=4');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('"status":"error"', (string)$response->getBody());
    }
}