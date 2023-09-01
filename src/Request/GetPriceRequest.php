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
    public $product;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[AppAssert\TaxNumber]
    public $taxNumber;

    #[Assert\NotBlank(
        allowNull: true
    )]
    #[Assert\Type('string')]
    public $couponCode = null;
}
