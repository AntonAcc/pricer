<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PriceGetTest extends WebTestCase
{
    public function testGetMethod(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/price/get');

        $this->assertResponseStatusCodeSame(400);

        $response = $client->getResponse();
        $responseContent = $response->getContent();
        $this->assertJsonStringEqualsJsonString('{"error":"Method GET is not allowed. Use POST method."}', $responseContent);
    }

    public function testPostMethod(): void
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/price/get');

        $this->assertResponseStatusCodeSame(200);

        $response = $client->getResponse();
        $responseContent = $response->getContent();
        $this->assertEquals('', $responseContent);
    }

//    public function testSomething(): void
//    {
//        $client = static::createClient();
//        $crawler = $client->request('GET', '/price/get');
//
////        $this->assertResponseIsSuccessful();
//        $this->assertResponseStatusCodeSame(200);
////        $this->assertSelectorTextContains('h1', 'Hello World');
//
//        $response = $client->getResponse();
//        $data = $response->getContent();
//        //dump($data);
//        $this->assertStringContainsString("OK", $data);
//    }
}
