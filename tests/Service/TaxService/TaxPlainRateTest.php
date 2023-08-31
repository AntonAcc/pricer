<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Tests\Service\TaxService;

use App\Service\TaxService\TaxPlainRate;
use PHPUnit\Framework\TestCase;

class TaxPlainRateTest extends TestCase
{
    public function testApply(): void
    {
        $tax = new TaxPlainRate(10);
        $this->assertEquals(110, $tax->apply(100));
    }
}

