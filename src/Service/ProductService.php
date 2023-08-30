<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        readonly private ProductRepositoryInterface $productRepository
    ) {}

    public function hasProductWithId($id): bool
    {
        return $this->productRepository->has($id);
    }

    public function getProductById($id): Product
    {
        return $this->productRepository->get($id);
    }
}
