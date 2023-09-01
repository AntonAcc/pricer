<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class PaymentProcessor extends Constraint
{
    public string $message = '';
}
