<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service\PaymentService;

interface PaymentProcessorInterface
{
    /**
     * @param float $price
     *
     * @return void
     */
    public function pay(float $price): void;
}
