<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PriceGetTaxNumberTest extends WebTestCase
{
    public function testNoCountryCode(): void
    {
        $client = static::createClient();
        $client->request('POST', '/price/get', [], [], [], '{
            "product": "1",
            "taxNumber": "123456789",
            "couponCode": "D15",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(400);
    }

    public function testUnknownCountryCode(): void
    {
        $client = static::createClient();
        $client->request('POST', '/price/get', [], [], [], '{
            "product": "1",
            "taxNumber": "ZZ123456789",
            "couponCode": "D15",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(400);
    }

    public function testDeLetterInTail(): void
    {
        $client = static::createClient();
        $client->request('POST', '/price/get', [], [], [], '{
            "product": "1",
            "taxNumber": "DEA23456789",
            "couponCode": "D15",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(400);
    }

    public function testDeWrongTailLength(): void
    {
        $client = static::createClient();
        $client->request('POST', '/price/get', [], [], [], '{
            "product": "1",
            "taxNumber": "DE12345678",
            "couponCode": "D15",
            "paymentProcessor": "paypal"
        }');
        $this->assertResponseStatusCodeSame(400);
    }
}
