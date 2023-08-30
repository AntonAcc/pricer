<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Coupon;

interface CouponRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return bool
     */
    public function has(string $id): bool;

    /**
     * @param string $id
     *
     * @return Coupon
     */
    public function get(string $id): Coupon;
}
