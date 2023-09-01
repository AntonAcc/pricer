<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AppAssert;

#[Assert\Cascade]
class PaymentRequest extends BaseActionRequest
{
    public GetPriceRequest $getPriceRequest;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[AppAssert\PaymentProcessor]
    public string $paymentProcessor;

    protected function populate(): void
    {
        $this->getPriceRequest = new GetPriceRequest($this->request);
        parent::populate();
    }
}
