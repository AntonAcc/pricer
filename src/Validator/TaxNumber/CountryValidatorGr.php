<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Validator\TaxNumber;

class CountryValidatorGr implements CountryValidatorInterface
{
    /**
     * {@inheritDoc}
     */
    public function isValid(string $taxNumber): bool
    {
        return preg_match('/^GR\d{9}$/', $taxNumber) === 1;
    }

    /**
     * {@inheritDoc}
     */
    public function errorMessage(): string
    {
        return "Greece tax number format: country code 'GR' + 9 digits. Example: GR123456789";
    }
}
