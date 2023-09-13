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

    readonly private float $priceValue;

    readonly private string $priceCurrency;

    /**
     * @param string $name
     * @param Price $price
     */
    public function __construct(
        readonly private string $name,
        private Price $price,
    ) {
        $this->priceValue = $price->getValue();
        $this->priceCurrency = $price->getCurrency();
    }

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
        if (!isset($this->price)) {
            $this->price = new Price(
                $this->priceValue,
                $this->priceCurrency
            );
        }

        return $this->price;
    }

    /**
     * @return float
     */
    public function getPriceValue(): float
    {
        return $this->price->getValue();
    }

    /**
     * @return string
     */
    public function getPriceCurrency(): string
    {
        return $this->price->getCurrency();
    }
}
