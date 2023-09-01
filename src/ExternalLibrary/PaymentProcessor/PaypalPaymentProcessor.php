<?php
/**
 * @author John Doe <johndoe@jmail.dom>
 */
declare(strict_types=1);

namespace App\ExternalLibrary\PaymentProcessor;

use Exception;

class PaypalPaymentProcessor
{
    /**
     * @throws Exception in case of a failed payment
     */
    public function pay(int $price): void
    {
        if ($price > 100000) {
            throw new Exception('Too high price');
        }

        //process payment logic
    }
}
