<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service;

use App\Entity\Coupon;
use App\Repository\CouponRepositoryInterface;

class CouponService
{
    public function __construct(
        readonly private CouponRepositoryInterface $couponRepository
    ) {}

    /**
     * @param string $id
     *
     * @return Coupon
     */
    public function getCouponById(string $id): Coupon
    {
        return $this->couponRepository->get($id);
    }

}
