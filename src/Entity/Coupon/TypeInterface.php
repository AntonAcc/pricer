<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Entity\Coupon;

interface TypeInterface
{
    /**
     * @param float $priceValue
     * @param float $discount
     *
     * @return bool
     */
    public function canBeApplied(float $priceValue, float $discount): bool;

    /**
     * @param float $priceValue
     * @param float $discount
     *
     * @return float
     */
    public function apply(float $priceValue, float $discount): float;
}
