<?php

/**
 * @author Anton Acc <antonxacc@gmail.com>
 */

declare(strict_types=1);

namespace App\Tests\Validator\TaxNumber;

use App\Validator\TaxNumber\CountryValidatorFr;
use App\Validator\TaxNumber\CountryValidatorInterface;
use PHPUnit\Framework\TestCase;

class CountryValidatorFrTest extends TestCase
{
    private CountryValidatorInterface $validator;

    public function setUp(): void
    {
        $this->validator = new CountryValidatorFr();
    }

    public function testWrongPrefix(): void
    {
        $this->assertFalse($this->validator->isValid('FFAZ123456789'));
    }

    public function testDigitInSecondPrefix(): void
    {
        $this->assertFalse($this->validator->isValid('FRA0123456789'));
    }

    public function testLetterInTail(): void
    {
        $this->assertFalse($this->validator->isValid('FRAZB23456789'));
    }

    public function testWrongTailLength(): void
    {
        $this->assertFalse($this->validator->isValid('FRAZ12345678'));
    }

    public function testCorrectFormat(): void
    {
        $this->assertTrue($this->validator->isValid('FRAZ123456789'));
    }
}

