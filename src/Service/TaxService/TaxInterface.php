<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\TaxService;

interface TaxInterface
{
    /**
     * @param float $priceValue
     *
     * @return float
     */
    public function apply(float $priceValue): float;
}
