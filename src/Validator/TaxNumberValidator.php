<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Validator;

use App\Validator\TaxNumber\CountryValidatorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TaxNumberValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof TaxNumber) {
            throw new UnexpectedTypeException($constraint, TaxNumber::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!\is_scalar($value) && !$value instanceof \Stringable) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if (preg_match('/^([A-Z]{2})/', $value, $matches) !== 1) {
            $this->context->buildViolation('Tax number should start with two capital letter country code. Example: DEXXXXXXXXX')->addViolation();

            return;
        }
        $countryCode = $matches[1];

        $taxNumberCountryValidatorClass = sprintf('\App\Validator\TaxNumber\CountryValidator%s', ucfirst(strtolower($countryCode)));
        if (!class_exists($taxNumberCountryValidatorClass)) {
            $this->context->buildViolation(sprintf('Unknown tax number country code %s', $countryCode))->addViolation();

            return;
        }

        /** @var CountryValidatorInterface $taxNumberCountryValidator */
        $taxNumberCountryValidator = new $taxNumberCountryValidatorClass();
        if (!$taxNumberCountryValidator->isValid($value)) {
            $this->context->buildViolation($taxNumberCountryValidator->errorMessage())->addViolation();
        }
    }

}
