<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\TaxService\Tax;

use App\Service\TaxService\TaxInterface;

class CountryRr implements TaxInterface
{
    public function getTaxRate(): float
    {
        return 20;
    }
}
