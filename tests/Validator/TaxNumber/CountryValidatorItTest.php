<?php

/**
 * @author Anton Acc <antonxacc@gmail.com>
 */

declare(strict_types=1);

namespace App\Tests\Validator\TaxNumber;

use App\Validator\TaxNumber\CountryValidatorIt;
use App\Validator\TaxNumber\CountryValidatorInterface;
use PHPUnit\Framework\TestCase;

class CountryValidatorItTest extends TestCase
{
    private CountryValidatorInterface $validator;

    public function setUp(): void
    {
        $this->validator = new CountryValidatorIt();
    }

    public function testWrongPrefix(): void
    {
        $this->assertFalse($this->validator->isValid('II12345678901'));
    }

    public function testLetterInTail(): void
    {
        $this->assertFalse($this->validator->isValid('ITA2345678901'));
    }

    public function testWrongTailLength(): void
    {
        $this->assertFalse($this->validator->isValid('IT1234567890'));
    }

    public function testCorrectFormat(): void
    {
        $this->assertTrue($this->validator->isValid('IT12345678901'));
    }
}

