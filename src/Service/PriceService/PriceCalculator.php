<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\PriceService;

use App\Entity\Product;
use App\ValueObject\Price;

class PriceCalculator
{
    /**
     * @param Product $product
     */
    public function __construct(
        readonly private Product $product
    ) {}

    /**
     * @return Price
     */
    public function calculate(): Price
    {
        return $this->product->getPrice();
    }
}
