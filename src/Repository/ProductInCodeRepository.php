<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use App\ValueObject\Price;
use DomainException;

class ProductInCodeRepository implements ProductRepositoryInterface
{
    private array $productList;

    public function __construct()
    {
        $this->productList = [
            '1' => new Product('Iphone', new Price(100, 'EUR')),
            '2' => new Product('Наушники', new Price(20, 'EUR')),
            '3' => new Product('Чехол', new Price(10, 'EUR')),
        ];
    }

    public function has(string $id): bool
    {
        return isset($this->productList[$id]);
    }

    public function get(string $id): Product
    {
        if (!isset($this->productList[$id])) {
            throw new DomainException(sprintf('Not found product with ID %s', $id));
        }

        return $this->productList[$id];
    }
}
