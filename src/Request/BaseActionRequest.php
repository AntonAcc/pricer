<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Request;

use App\Exception\MethodException;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseActionRequest
{
    public function __construct(protected Request $request)
    {
        if (!$request->isMethod(Request::METHOD_POST)) {
            throw new MethodException($request->getMethod(), Request::METHOD_POST);
        }

        $this->populate();
    }

    protected function populate(): void
    {
        foreach ($this->request->toArray() as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}