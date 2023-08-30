<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Validator\TaxNumber;

class CountryValidatorDe implements CountryValidatorInterface
{
    /**
     * {@inheritDoc}
     */
    public function isValid(string $taxNumber): bool
    {
        return preg_match('/^DE\d{9}$/', $taxNumber) === 1;
    }

    /**
     * {@inheritDoc}
     */
    public function errorMessage(): string
    {
        return "Germany tax number format: country code 'DE' + 9 digits. Example: DE123456789";
    }
}
