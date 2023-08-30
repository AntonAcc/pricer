<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Controller;

use App\Exception\MethodException;
use App\Exception\TaxNumberException;
use App\Request\BaseActionRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

abstract class BaseController extends AbstractController
{
    public function __construct(
        private readonly ValidatorInterface $validator
    ) {}

    /**
     * @param Request $request
     *
     * @return BaseActionRequest
     */
    abstract protected function convertRequest(Request $request): BaseActionRequest;

    /**
     * @param BaseActionRequest $actionRequest
     *
     * @return Response
     */
    abstract protected function processActionRequest(BaseActionRequest $actionRequest): Response;

    /**
     * @param Request $request
     *
     * @return Response
     */
    protected function processRequest(Request $request): Response
    {
        try {
            $actionRequest = $this->convertRequest($request);
            $errors = $this->validator->validate($actionRequest);

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

            return $this->processActionRequest($actionRequest);
        } catch (JsonException $e) {
            $messages = ['message' => 'json_error', 'errors' => [$e->getMessage()]];

            return $this->json($messages, 400);
        } catch (MethodException $e) {
            $messages = ['message' => 'method_error', 'errors' => [$e->getMessage()]];

            return $this->json($messages, 400);
        } catch (TaxNumberException $e) {
            $messages = ['message' => 'tax_number_error', 'errors' => [$e->getMessage()]];

            return $this->json($messages, 400);
        } catch (Throwable $e) {
            $messages = ['message' => 'unknown_error', 'errors' => [$e->getMessage()]];

            return $this->json($messages, 400);
        }
    }
}
