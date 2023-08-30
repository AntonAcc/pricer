<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\TaxService;

class TaxPlainRate implements TaxInterface
{

    public function __construct(
        readonly private float $taxRate
    ) {}

    public function getTaxRate(): float
    {
        return $this->taxRate;
    }

    public function apply(float $priceValue): float
    {
        return $priceValue * (1 + $this->taxRate / 100);
    }
}
