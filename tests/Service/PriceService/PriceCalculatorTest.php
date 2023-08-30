<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Tests\Service\PriceService;

use App\Entity\Product;
use App\Service\PriceService\PriceCalculator;
use App\Service\TaxService\TaxInterface;
use App\ValueObject\Price;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
    public function testNoTax(): void
    {
        $product = new Product('Iphone', new Price(100, 'EUR'));
        $priceCalculator = new PriceCalculator($product);
        $price = $priceCalculator->calculate();

        $this->assertEquals(100, $price->getValue());
        $this->assertEquals('EUR', $price->getCurrency());
    }

    public function testWithTax(): void
    {
        $product = new Product('Iphone', new Price(100, 'EUR'));
        $priceCalculator = new PriceCalculator($product);
        $taxMock = $this->createMock(TaxInterface::class);
        $taxMock->method('getTaxRate')->willReturn(15.0);
        $priceCalculator->withTax($taxMock);
        $price = $priceCalculator->calculate();

        $this->assertEquals(115.0, $price->getValue());
        $this->assertEquals('EUR', $price->getCurrency());
    }
}

