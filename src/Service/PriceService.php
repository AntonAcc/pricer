<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Service;

use App\Request\GetPriceRequest;
use App\Service\PriceService\PriceCalculator;
use App\ValueObject\Price;

class PriceService
{
    public function __construct(
        readonly private TaxService $taxService,
        readonly private ProductService $productService,
        readonly private CouponService $couponService
    ) {}

    public function getPrice(GetPriceRequest $getPriceRequest): Price
    {
        // TODO Check product with hasProductWithId
        $product = $this->productService->getProductById($getPriceRequest->product);

        $priceCalculator = (new PriceCalculator($product))
            ->withTax($this->taxService->getTaxByTaxNumber($getPriceRequest->taxNumber));

        if ($getPriceRequest->couponCode) {
            $priceCalculator->withCoupon($this->couponService->getCouponById($getPriceRequest->couponCode));
        }

        return $priceCalculator->calculate();
    }
}
