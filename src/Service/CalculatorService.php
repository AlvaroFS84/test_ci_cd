<?php

namespace App\Service;

class CalculatorService
{
    public function sum(float $a, float $b): float
    {
        return $a + $b;
    }

    public function multiply(float $a, float $b): float
    {
        return $a * $b;
    }
}
