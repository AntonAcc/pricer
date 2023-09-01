<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service;

use App\Request\PaymentRequest;
use App\Service\PaymentService\PaymentProcessorFactory;

class PaymentService
{
    /**
     * @param PriceService $priceService
     */
    public function __construct(
        readonly private PriceService $priceService
    ) {}

    /**
     * @param PaymentRequest $paymentRequest
     *
     * @return void
     */
    public function processPayment(PaymentRequest $paymentRequest): void
    {
        $price = $this->priceService->getPrice($paymentRequest->getPriceRequest);
        $paymentProcessor = PaymentProcessorFactory::byId($paymentRequest->paymentProcessor);
        // TODO Maybe conversion to different currency is required
        $paymentProcessor->pay($price->getValue());
    }
}
