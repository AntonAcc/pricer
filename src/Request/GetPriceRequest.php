<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AppAssert;

class GetPriceRequest extends BaseActionRequest
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $product;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[AppAssert\TaxNumber]
    public string $taxNumber;

    #[Assert\NotBlank(
        allowNull: true
    )]
    #[Assert\Type('string')]
    public ?string $couponCode = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $paymentProcessor;
}
