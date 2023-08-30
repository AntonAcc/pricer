<?php

/**
 * @author Anton Acc <antonxacc@gmail.com>
 */

declare(strict_types=1);

namespace App\Tests\Validator\TaxNumber;

use App\Validator\TaxNumber\CountryValidatorGr;
use App\Validator\TaxNumber\CountryValidatorInterface;
use PHPUnit\Framework\TestCase;

class CountryValidatorGrTest extends TestCase
{
    private CountryValidatorInterface $validator;

    public function setUp(): void
    {
        $this->validator = new CountryValidatorGr();
    }

    public function testWrongPrefix(): void
    {
        $this->assertFalse($this->validator->isValid('GG123456789'));
    }

    public function testLetterInTail(): void
    {
        $this->assertFalse($this->validator->isValid('GRA23456789'));
    }

    public function testWrongTailLength(): void
    {
        $this->assertFalse($this->validator->isValid('GR12345678'));
    }

    public function testCorrectFormat(): void
    {
        $this->assertTrue($this->validator->isValid('GR123456789'));
    }
}

