<?php
/**
 * @author Jane Doe <janedoe@jmail.dom>
 */
declare(strict_types=1);

namespace App\ExternalLibrary\PaymentProcessor;

class StripePaymentProcessor
{
    /**
     * @return bool true if payment was succeeded, false otherwise
     */
    public function processPayment(int $price): bool
    {
        if ($price < 100) {
            return false;
        }

        //process payment logic
        return true;
    }
}
