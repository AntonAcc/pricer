<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Controller;

use App\Exception\PaymentException;
use App\Request\BaseActionRequest;
use App\Request\PaymentRequest;
use App\Service\PaymentService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PaymentController extends BaseController
{
    public function __construct(
        ValidatorInterface $validator,
        private readonly PaymentService $paymentService
    ) {
        parent::__construct($validator);
    }

    #[Route('/payment/process', name: 'payment_process')]
    public function process(Request $request): Response
    {
        return $this->processRequest($request);
    }

    /**
     * {@inheritDoc}
     */
    protected function convertRequest(Request $request): BaseActionRequest
    {
        return new PaymentRequest($request);
    }

    /**
     * {@inheritDoc}
     */
    protected function processActionRequest(BaseActionRequest|PaymentRequest $actionRequest): Response
    {
        try {
            $this->paymentService->processPayment($actionRequest);
        } catch (PaymentException $e) {
            $messages = ['message' => 'payment_error', 'errors' => [$e->getMessage()]];

            return $this->json($messages, 400);
        }

        return $this->json(['result' => 'success']);
    }
}
