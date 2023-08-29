<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class PriceRequest extends BaseRequest
{
    #[Assert\NotBlank]
    protected int $product;

    #[Assert\NotBlank]
    protected string $taxNumber;

    #[Assert\NotBlank]
    protected string $couponCode;

    #[Assert\NotBlank]
    protected string $paymentProcessor;
}
