<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\TaxService;

use App\Exception\TaxNumberException;

class TaxFactory
{
    public static function byTaxNumber(string $taxNumber): TaxInterface
    {
        if (preg_match('/^([A-Z]{2})/', $taxNumber, $matches) !== 1) {
            throw new TaxNumberException('Tax number should start with two capital letters');
        }
        $countryCode = $matches[1];

        $taxClass = sprintf('\App\Service\TaxService\Tax\Country%s', ucfirst(strtolower($countryCode)));
        if (!class_exists($taxClass)) {
            throw new TaxNumberException(sprintf('Unknown tax number country code %s', $countryCode));
        }

        return new $taxClass();
    }
}
