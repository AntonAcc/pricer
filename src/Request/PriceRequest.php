<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Request;

class PriceRequest extends BaseRequest
{
    private int $product;
    private int $taxNumber;
    private int $couponCode;
    private int $paymentProcessor;
}
