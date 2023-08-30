<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\PriceService;

use App\Entity\Product;
use App\Service\TaxService\TaxInterface;
use App\ValueObject\Price;

class PriceCalculator
{
    private ?TaxInterface $tax = null;

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
        $result = $this->product->getPriceValue();
        if ($this->tax !== null) {
            $result *= (1 + $this->tax->getTaxRate() / 100);
        }

        $result = round($result, 10);

        return new Price($result, $this->product->getPriceCurrency());
    }

    /**
     * @param TaxInterface $tax
     *
     * @return self
     */
    public function withTax(TaxInterface $tax): self
    {
        $this->tax = $tax;

        return $this;
    }
}
