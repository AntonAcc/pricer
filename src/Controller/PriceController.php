<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Controller;

use App\Request\BaseActionRequest;
use App\Request\GetPriceRequest;
use App\Service\PriceService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PriceController extends BaseController
{
    public function __construct(
        ValidatorInterface $validator,
        private readonly PriceService $priceService
    ) {
        parent::__construct($validator);
    }

    #[Route('/price/get', name: 'price_get')]
    public function get(Request $request): Response
    {
        return $this->processRequest($request);
    }

    /**
     * {@inheritDoc}
     */
    protected function convertRequest(Request $request): BaseActionRequest
    {
        return new GetPriceRequest($request);
    }

    /**
     * {@inheritDoc}
     */
    protected function processActionRequest(BaseActionRequest|GetPriceRequest $actionRequest): Response
    {
        $price = $this->priceService->getPrice($actionRequest);

        return $this->json(['price' =>  [
            'value' => $price->getValue(),
            'currency' => $price->getCurrency(),
        ]]);
    }
}
