<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Coupon;
use DomainException;

class CouponInCodeRepository implements CouponRepositoryInterface
{
    private array $couponList;

    public function __construct()
    {
        $this->couponList = [
            'D15' => new Coupon(15, Coupon::TYPE_RATE),
            'S10' => new Coupon(10, Coupon::TYPE_SUM),
        ];
    }

    public function has(string $id): bool
    {
        return isset($this->couponList[$id]);
    }

    public function get(string $id): Coupon
    {
        if (!isset($this->couponList[$id])) {
            throw new DomainException(sprintf('Not found coupon with ID %s', $id));
        }

        return $this->couponList[$id];
    }
}
