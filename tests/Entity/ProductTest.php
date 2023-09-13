<?php
/**
 * @author Anton Acc <me@anton-a.cc>
 */
declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ProductTest extends TestCase
{
    public function testPriceSet(): void
    {
        $productReflection = new ReflectionClass(Product::class);
        $product = $productReflection->newInstanceWithoutConstructor();

        $productReflection->getProperty('priceValue')->setValue($product, 50);
        $productReflection->getProperty('priceCurrency')->setValue($product, 'EUR');

        $price = $product->getPrice();

        $this->assertEquals(50, $price->getValue());
        $this->assertEquals('EUR', $price->getCurrency());
    }
}

