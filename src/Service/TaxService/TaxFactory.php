<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\TaxService;

use App\Exception\TaxNumberException;
use UnhandledMatchError;

class TaxFactory
{
    private const COUNTRY_CODE_DE = 'DE';
    private const COUNTRY_CODE_FR = 'FR';
    private const COUNTRY_CODE_GR = 'GR';
    private const COUNTRY_CODE_IT = 'IT';

    public static function byTaxNumber(string $taxNumber): TaxInterface
    {
        if (preg_match('/^([A-Z]{2})/', $taxNumber, $matches) !== 1) {
            throw new TaxNumberException('Tax number should start with two capital letters');
        }
        $countryCode = $matches[1];

        try {
            return match ($countryCode) {
                self::COUNTRY_CODE_DE => new TaxPlainRate(19),
                self::COUNTRY_CODE_FR => new TaxPlainRate(20),
                self::COUNTRY_CODE_GR => new TaxPlainRate(24),
                self::COUNTRY_CODE_IT => new TaxPlainRate(22),
            };
        } catch (UnhandledMatchError $e) {
            throw new TaxNumberException(sprintf('Unknown tax number country code %s', $countryCode));
        }
    }
}
