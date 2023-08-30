<?php

/**
 * @author Anton Acc <antonxacc@gmail.com>
 */

declare(strict_types=1);

namespace App\Validator\TaxNumber;

interface CountryValidatorInterface
{
    /**
     * @param string $taxNumber
     *
     * @return bool
     */
    public function isValid(string $taxNumber): bool;

    /**
     * @return string
     */
    public function errorMessage(): string;
}
