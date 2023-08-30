<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service;

use App\Request\PriceRequest;
use App\Service\PriceService\PriceCalculator;
use App\ValueObject\Price;

class PriceService
{
    public function __construct(
        readonly private ProductService $productService
    ) {}

    public function getPrice(PriceRequest $priceRequest): Price
    {
        // TODO Check product with hasProductWithId
        $product = $this->productService->getProductById($priceRequest->product);

        $priceCalculator = new PriceCalculator($product);

        return $priceCalculator->calculate();
    }
}
