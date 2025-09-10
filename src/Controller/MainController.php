<?php

namespace App\Controller;

use App\Service\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    public function __construct(
        private readonly CalculatorService $calculator
    ) {
    }

    #[Route('/sum/{a}/{b}', name: 'sum', methods: ['GET'])]
    public function sum(string $a, string $b): Response
    {
        if (!is_numeric($a) || !is_numeric($b)) {
            return $this->json(['error' => 'Los parámetros deben ser numéricos'], 400);
        }

        $result = $this->calculator->sum((float) $a, (float) $b);

        return $this->json([
            'operation' => 'sum',
            'a' => (float) $a,
            'b' => (float) $b,
            'result' => $result,
        ]);
    }

    #[Route('/multiply/{a}/{b}', name: 'multiply', methods: ['GET'])]
    public function multiply(string $a, string $b): Response
    {
        if (!is_numeric($a) || !is_numeric($b)) {
            return $this->json(['error' => 'Los parámetros deben ser numéricos'], 400);
        }

        $result = $this->calculator->multiply((float) $a, (float) $b);

        return $this->json([
            'operation' => 'multiply',
            'a' => (float) $a,
            'b' => (float) $b,
            'result' => $result,
        ]);
    }

    #[Route('/sum', name: 'sum_json', methods: ['POST'])]
    public function sumJson(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        if (!is_array($data) || !array_key_exists('a', $data) || !array_key_exists('b', $data)) {
            return $this->json(['error' => 'JSON inválido. Se requiere {"a": number, "b": number}'], 400);
        }

        $a = $data['a'];
        $b = $data['b'];

        if (!is_numeric($a) || !is_numeric($b)) {
            return $this->json(['error' => 'Los parámetros deben ser numéricos'], 400);
        }

        $result = $this->calculator->sum((float) $a, (float) $b);

        return $this->json([
            'operation' => 'sum',
            'a' => (float) $a,
            'b' => (float) $b,
            'result' => $result,
        ]);
    }

    #[Route('/multiply', name: 'multiply_json', methods: ['POST'])]
    public function multiplyJson(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        if (!is_array($data) || !array_key_exists('a', $data) || !array_key_exists('b', $data)) {
            return $this->json(['error' => 'JSON inválido. Se requiere {"a": number, "b": number}'], 400);
        }

        $a = $data['a'];
        $b = $data['b'];

        if (!is_numeric($a) || !is_numeric($b)) {
            return $this->json(['error' => 'Los parámetros deben ser numéricos'], 400);
        }

        $result = $this->calculator->multiply((float) $a, (float) $b);

        return $this->json([
            'operation' => 'multiply',
            'a' => (float) $a,
            'b' => (float) $b,
            'result' => $result,
        ]);
    }
}