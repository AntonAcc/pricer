<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Validator\TaxNumber;

class CountryValidatorIt implements CountryValidatorInterface
{
    /**
     * {@inheritDoc}
     */
    public function isValid(string $taxNumber): bool
    {
        return preg_match('/^IT\d{11}$/', $taxNumber) === 1;
    }

    /**
     * {@inheritDoc}
     */
    public function errorMessage(): string
    {
        return "Italy tax number format: country code 'IT' + 11 digits. Example: IT12345678901";
    }
}
