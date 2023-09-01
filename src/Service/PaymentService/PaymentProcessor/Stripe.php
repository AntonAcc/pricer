<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\PaymentService\PaymentProcessor;

use App\Exception\PaymentException;
use App\ExternalLibrary\PaymentProcessor\StripePaymentProcessor;
use App\Service\PaymentService\PaymentProcessorInterface;
use Throwable;

class Stripe implements PaymentProcessorInterface
{
    /**
     * @param StripePaymentProcessor $paymentProcessor
     */
    public function __construct(
        readonly private StripePaymentProcessor $paymentProcessor
    ){}

    /**
     * {@inheritDoc}
     */
    public function pay(float $price): void
    {
        try {
            $result = $this->paymentProcessor->processPayment((int) $price);
            if ($result !== true) {
                throw new PaymentException('Payment error');
            }
        } catch (Throwable $e) {
            throw new PaymentException(sprintf('Payment error: %s', $e->getMessage()));
        }
    }
}
