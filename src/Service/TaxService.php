<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service;

use App\Service\TaxService\TaxFactory;
use App\Service\TaxService\TaxInterface;

class TaxService
{
    public function getTaxByTaxNumber(string $taxNumber): TaxInterface
    {
        return TaxFactory::byTaxNumber($taxNumber);
    }
}
