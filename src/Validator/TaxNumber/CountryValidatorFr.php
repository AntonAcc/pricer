<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Validator\TaxNumber;

class CountryValidatorFr implements CountryValidatorInterface
{
    /**
     * {@inheritDoc}
     */
    public function isValid(string $taxNumber): bool
    {
        return preg_match('/^FR[A-Z]{2}\d{9}$/', $taxNumber) === 1;
    }

    /**
     * {@inheritDoc}
     */
    public function errorMessage(): string
    {
        return "Greece tax number format: country code 'FR' + 2 Capital Letters + 9 digits. Example: FRAZ123456789";
    }
}
