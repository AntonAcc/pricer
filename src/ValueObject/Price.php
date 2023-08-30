<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\ValueObject;

class Price
{
    /**
     * @param float $value
     * @param string $currency
     */
    public function __construct(
        readonly private float  $value,
        readonly private string $currency,
    ) {}

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}
