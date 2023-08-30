<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Entity\Coupon;

class TypeRate implements TypeInterface
{
    /**
     * {@inheritDoc}
     */
    public function canBeApplied(float $priceValue, float $discount): bool
    {
        return $this->apply($priceValue, $discount) > ($priceValue / 2);
    }

    /**
     * {@inheritDoc}
     */
    public function apply(float $priceValue, float $discount): float
    {
        return $priceValue * (1 - $discount / 100);
    }
}
