<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\PaymentService;

use App\Exception\PaymentException;
use App\ExternalLibrary\PaymentProcessor\PaypalPaymentProcessor;
use App\ExternalLibrary\PaymentProcessor\StripePaymentProcessor;
use App\Service\PaymentService\PaymentProcessor\Paypal;
use App\Service\PaymentService\PaymentProcessor\Stripe;
use UnhandledMatchError;

class PaymentProcessorFactory
{
    private const PAYMENT_PROCESSOR_PAYPAL = 'paypal';
    private const PAYMENT_PROCESSOR_STRIPE = 'stripe';

    /**
     * @param string $id
     *
     * @return bool
     */
    public static function isAvailableId(string $id): bool
    {
        $availableIdList = [
            self::PAYMENT_PROCESSOR_PAYPAL,
            self::PAYMENT_PROCESSOR_STRIPE,
        ];

        return in_array($id, $availableIdList);
    }

    /**
     * @param string $id
     *
     * @return PaymentProcessorInterface
     */
    public static function byId(string $id): PaymentProcessorInterface
    {
        try {
            return match ($id) {
                self::PAYMENT_PROCESSOR_PAYPAL => new Paypal(new PaypalPaymentProcessor()),
                self::PAYMENT_PROCESSOR_STRIPE => new Stripe(new StripePaymentProcessor()),
            };
        } catch (UnhandledMatchError $e) {
            throw new PaymentException(sprintf("Unknown payment processor id '%s'", $id));
        }
    }
}
