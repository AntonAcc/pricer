<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PaymentTest extends WebTestCase
{
    public function testGetMethod(): void
    {
        $client = static::createClient();
        $client->request('GET', '/payment/process');

        $this->assertResponseStatusCodeSame(400);

        $response = $client->getResponse();
        $responseContent = $response->getContent();
        $this->assertJsonStringEqualsJsonString('{"message":"method_error","errors":["Method GET is not allowed. Use POST method."]}', $responseContent);
    }

    public function testRequestIsEmpty(): void
    {
        $client = static::createClient();
        $client->request('POST', '/payment/process');

        $this->assertResponseStatusCodeSame(400);

        $response = $client->getResponse();
        $responseContent = $response->getContent();
        $this->assertJsonStringEqualsJsonString('{"message":"json_error","errors":["Request body is empty."]}', $responseContent);
    }

    public function testRequestInvalidJson(): void
    {
        $client = static::createClient();
        $client->request('POST', '/payment/process', [], [], [], '{\}');

        $this->assertResponseStatusCodeSame(400);

        $response = $client->getResponse();
        $responseContent = $response->getContent();
        $this->assertJsonStringEqualsJsonString('{"message":"json_error","errors":["Could not decode request body."]}', $responseContent);
    }

    public function testRequestProductIsEmpty(): void
    {
        $client = static::createClient();
        $client->request('POST', '/payment/process', [], [], [], '{
            "taxNumber": "DE123456789",
            "couponCode": "D15",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(400);
    }

    public function testRequestTaxNumberIsEmpty(): void
    {
        $client = static::createClient();
        $client->request('POST', '/payment/process', [], [], [], '{
            "product": "1",
            "couponCode": "D15",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(400);
    }

    public function testRequestCouponCodeIsNotRequired(): void
    {
        $client = static::createClient();
        $client->request('POST', '/payment/process', [], [], [], '{
            "product": "1",
            "taxNumber": "DE123456789",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testRequestPaymentProcessorIsEmpty(): void
    {
        $client = static::createClient();
        $client->request('POST', '/payment/process', [], [], [], '{
            "product": "1",
            "taxNumber": "DE123456789",
            "couponCode": "D15"
        }');
        $this->assertResponseStatusCodeSame(400);
    }

    public function testCorrectRequest(): void
    {
        $client = static::createClient();
        $client->request('POST', '/payment/process', [], [], [], '{
            "product": "1",
            "taxNumber": "DE123456789",
            "couponCode": "D15",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testUnknownPaymentProcessor(): void
    {
        $client = static::createClient();
        $client->request('POST', '/payment/process', [], [], [], '{
            "product": "1",
            "taxNumber": "DE123456789",
            "couponCode": "D15",
            "paymentProcessor": "pay_some_service"
        }');
        $this->assertResponseStatusCodeSame(400);
    }
}
