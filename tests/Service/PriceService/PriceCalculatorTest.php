<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Tests\Service\PriceService;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Service\PriceService\PriceCalculator;
use App\Service\TaxService\TaxPlainRate;
use App\ValueObject\Price;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
    public function testNoTaxNoCoupon(): void
    {
        $product = new Product('Iphone', new Price(100, 'EUR'));
        $priceCalculator = new PriceCalculator($product);
        $price = $priceCalculator->calculate();

        $this->assertEquals(100, $price->getValue());
        $this->assertEquals('EUR', $price->getCurrency());
    }

    public function testWithTaxNoCoupon(): void
    {
        $product = new Product('Iphone', new Price(100, 'EUR'));
        $priceCalculator = new PriceCalculator($product);
        $priceCalculator->withTax(new TaxPlainRate(15.0));
        $price = $priceCalculator->calculate();

        $this->assertEquals(115.0, $price->getValue());
        $this->assertEquals('EUR', $price->getCurrency());
    }

    public function testNoTaxWithCoupon(): void
    {
        $product = new Product('Iphone', new Price(100, 'EUR'));
        $priceCalculator = new PriceCalculator($product);
        $priceCalculator->withCoupon(new Coupon(25, Coupon::TYPE_SUM));

        $price = $priceCalculator->calculate();

        $this->assertEquals(75, $price->getValue());
        $this->assertEquals('EUR', $price->getCurrency());
    }

    public function testWithTaxWithCoupon(): void
    {
        $product = new Product('Iphone', new Price(100, 'EUR'));
        $priceCalculator = new PriceCalculator($product);
        $priceCalculator->withTax(new TaxPlainRate(24.0));
        $priceCalculator->withCoupon(new Coupon(6, Coupon::TYPE_RATE));

        $price = $priceCalculator->calculate();

        $this->assertEquals(116.56, $price->getValue());
        $this->assertEquals('EUR', $price->getCurrency());
    }
}

