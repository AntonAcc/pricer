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

    public function apply(float $priceValue): float
    {
        return round($priceValue * (1 + $this->taxRate / 100), 10);
    }
}
