<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Entity;

use App\ValueObject\Price;

class Product
{
    readonly private string $id;

    /**
     * @param string $name
     * @param Price $price
     */
    public function __construct(
        readonly private string $name,
        readonly private Price $price,
    ) {}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }
}
