<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Entity;

use App\Entity\Coupon\TypeInterface;
use App\Entity\Coupon\TypeRate;
use App\Entity\Coupon\TypeSum;

class Coupon
{
    public const TYPE_SUM = 'type_sum';
    public const TYPE_RATE = 'type_rate';

    private float $discount;
    private TypeInterface $couponType;

    /**
     * @param float $discount
     * @param string $couponTypeId
     */
    public function __construct(float $discount, string $couponTypeId)
    {
        $this->discount = $discount;

        $this->couponType = match ($couponTypeId) {
            self::TYPE_SUM => new TypeSum(),
            self::TYPE_RATE => new TypeRate(),
        };
    }


    public function apply(float $priceValue): float
    {
        return $this->couponType->apply($priceValue, $this->discount);
    }
}
