<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PriceGetTest extends WebTestCase
{
    public function testGetMethod(): void
    {
        $client = static::createClient();
        $client->request('GET', '/price/get');

        $this->assertResponseStatusCodeSame(400);

        $response = $client->getResponse();
        $responseContent = $response->getContent();
        $this->assertJsonStringEqualsJsonString('{"message":"method_error","errors":["Method GET is not allowed. Use POST method."]}', $responseContent);
    }

    public function testRequestIsEmpty(): void
    {
        $client = static::createClient();
        $client->request('POST', '/price/get');

        $this->assertResponseStatusCodeSame(400);

        $response = $client->getResponse();
        $responseContent = $response->getContent();
        $this->assertJsonStringEqualsJsonString('{"message":"json_error","errors":["Request body is empty."]}', $responseContent);
    }

    public function testRequestInvalidJson(): void
    {
        $client = static::createClient();
        $client->request('POST', '/price/get', [], [], [], '{\}');

        $this->assertResponseStatusCodeSame(400);

        $response = $client->getResponse();
        $responseContent = $response->getContent();
        $this->assertJsonStringEqualsJsonString('{"message":"json_error","errors":["Could not decode request body."]}', $responseContent);
    }

    public function testRequestProductIsEmpty(): void
    {
        $client = static::createClient();
        $client->request('POST', '/price/get', [], [], [], '{
            "taxNumber": "DE123456789",
            "couponCode": "D15",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(400);
    }

    public function testRequestTaxNumberIsEmpty(): void
    {
        $client = static::createClient();
        $client->request('POST', '/price/get', [], [], [], '{
            "product": "1",
            "couponCode": "D15",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(400);
    }

    public function testRequestCouponCodeIsNotRequired(): void
    {
        $client = static::createClient();
        $client->request('POST', '/price/get', [], [], [], '{
            "product": "1",
            "taxNumber": "DE123456789",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testRequestPaymentProcessorIsEmpty(): void
    {
        $client = static::createClient();
        $client->request('POST', '/price/get', [], [], [], '{
            "product": "1",
            "taxNumber": "DE123456789",
            "couponCode": "D15"
        }');
        $this->assertResponseStatusCodeSame(400);
    }

    public function testCorrectRequest(): void
    {
        $client = static::createClient();
        $client->request('POST', '/price/get', [], [], [], '{
            "product": "1",
            "taxNumber": "DE123456789",
            "couponCode": "D15",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(200);
    }
}
