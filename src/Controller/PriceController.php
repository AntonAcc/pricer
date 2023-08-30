<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Controller;

use App\Exception\MethodException;
use App\Exception\TaxNumberException;
use App\Request\PriceRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

class PriceController extends AbstractController
{
    public function __construct(private readonly ValidatorInterface $validator)
    {
    }

    #[Route('/price/get', name: 'price_get')]
    public function get(Request $request): Response
    {
        try {
            $priceRequest = new PriceRequest($request);
            $errors = $this->validator->validate($priceRequest);

            if ($errors->count() > 0) {
                $messages = ['message' => 'request_data_error', 'errors' => []];

                /** @var ConstraintViolation $errors */
                foreach ($errors as $message) {
                    $messages['errors'][] = [
                        'property' => $message->getPropertyPath(),
                        'value' => $message->getInvalidValue(),
                        'message' => $message->getMessage(),
                    ];
                }

                return $this->json($messages, 400);
            }
        } catch (JsonException $e) {
            $messages = ['message' => 'json_error', 'errors' => [$e->getMessage()]];

            return $this->json($messages, 400);
        } catch (MethodException $e) {
            $messages = ['message' => 'method_error', 'errors' => [$e->getMessage()]];

            return $this->json($messages, 400);
        } catch (Throwable $e) {
            $messages = ['message' => 'unknown_error', 'errors' => [$e->getMessage()]];

            return $this->json($messages, 400);
        }

        return new Response();
    }
}
