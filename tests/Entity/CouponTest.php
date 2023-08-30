<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Coupon;
use PHPUnit\Framework\TestCase;

class CouponTest extends TestCase
{
    public function testSumType(): void
    {
        $coupon = new Coupon(10, Coupon::TYPE_SUM);
        $this->assertEquals(20, $coupon->apply(30));
    }

    public function testRateType(): void
    {
        $coupon = new Coupon(15, Coupon::TYPE_RATE);
        $this->assertEquals(85, $coupon->apply(100));
    }
}

