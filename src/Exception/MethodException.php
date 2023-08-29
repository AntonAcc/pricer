<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Exception;

class MethodException extends \LogicException
{
    /**
     * @param string $currentMethod
     * @param string $expectedMethod
     */
    public function __construct(string $currentMethod, string $expectedMethod)
    {
        parent::__construct(sprintf('Method %s is not allowed. Use %s method.', $currentMethod, $expectedMethod));
    }
}
