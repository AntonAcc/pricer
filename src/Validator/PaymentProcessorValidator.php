<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Validator;

use App\Service\PaymentService\PaymentProcessorFactory;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class PaymentProcessorValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof PaymentProcessor) {
            throw new UnexpectedTypeException($constraint, PaymentProcessor::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!\is_scalar($value) && !$value instanceof \Stringable) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if (!PaymentProcessorFactory::isAvailableId($value)) {
            $this->context->buildViolation(sprintf("Unknown payment processor id '%s'", $value))->addViolation();
        }
    }

}
