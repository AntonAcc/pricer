<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\TaxService;

interface TaxInterface
{
    /**
     * @return float
     */
    public function getTaxRate(): float;
}