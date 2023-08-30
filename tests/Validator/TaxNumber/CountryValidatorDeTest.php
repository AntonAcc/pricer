<?php

/**
 * @author Anton Acc <antonxacc@gmail.com>
 */

declare(strict_types=1);

namespace App\Tests\Validator\TaxNumber;

use App\Validator\TaxNumber\CountryValidatorDe;
use App\Validator\TaxNumber\CountryValidatorInterface;
use PHPUnit\Framework\TestCase;

class CountryValidatorDeTest extends TestCase
{
    private CountryValidatorInterface $validator;

    public function setUp(): void
    {
        $this->validator = new CountryValidatorDe();
    }

    public function testWrongPrefix(): void
    {
        $this->assertFalse($this->validator->isValid('DD123456789'));
    }

    public function testLetterInTail(): void
    {
        $this->assertFalse($this->validator->isValid('DEA23456789'));
    }

    public function testWrongTailLength(): void
    {
        $this->assertFalse($this->validator->isValid('DE12345678'));
    }

    public function testCorrectFormat(): void
    {
        $this->assertTrue($this->validator->isValid('DE123456789'));
    }
}

