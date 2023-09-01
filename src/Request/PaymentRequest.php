<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

#[Assert\Cascade]
class PaymentRequest extends BaseActionRequest
{
    public GetPriceRequest $getPriceRequest;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $paymentProcessor;

    protected function populate(): void
    {
        $this->getPriceRequest = new GetPriceRequest($this->request);
        parent::populate();
    }
}
