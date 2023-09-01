<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\PaymentService\PaymentProcessor;

use App\Exception\PaymentException;
use App\ExternalLibrary\PaymentProcessor\PaypalPaymentProcessor;
use App\Service\PaymentService\PaymentProcessorInterface;
use Throwable;

class Paypal implements PaymentProcessorInterface
{
    /**
     * @param PaypalPaymentProcessor $paymentProcessor
     */
    public function __construct(
        readonly private PaypalPaymentProcessor $paymentProcessor
    ){}

    /**
     * {@inheritDoc}
     */
    public function pay(float $price): void
    {
        try {
            $this->paymentProcessor->pay((int) $price);
        } catch (Throwable $e) {
            throw new PaymentException(sprintf('Payment error: %s', $e->getMessage()));
        }
    }
}
