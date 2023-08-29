<?php
/**
 * @author Anton Acc <antonxacc@gmail.com>
 */
declare(strict_types=1);

namespace App\Controller;

use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class PriceController extends AbstractController
{
    #[Route('/price/get', name: 'price_get')]
    public function get(Request $request): Response
    {
        try {
            if (!$request->isMethod(Request::METHOD_POST)) {
                throw new LogicException(sprintf('Method %s is not allowed. Use POST method.', $request->getMethod()));
            }
        } catch (Throwable $e) {
            $response = [
                'error' => $e->getMessage(),
            ];

            return $this->json($response, 400);
        }

        return new Response();
    }
}
