<?php

namespace App\Tests\Service;

use App\Service\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorServiceTest extends TestCase
{
    private CalculatorService $calculatorService;

    protected function setUp(): void
    {
        $this->calculatorService = new CalculatorService();
    }

    public function testSumWithPositiveNumbers(): void
    {
        $result = $this->calculatorService->sum(2.0, 3.0);
        $this->assertEquals(5.0, $result);
    }

    public function testSumWithNegativeNumbers(): void
    {
        $result = $this->calculatorService->sum(-2.0, -3.0);
        $this->assertEquals(-5.0, $result);
    }

    public function testSumWithMixedNumbers(): void
    {
        $result = $this->calculatorService->sum(-2.0, 5.0);
        $this->assertEquals(3.0, $result);
    }

    public function testSumWithZero(): void
    {
        $result = $this->calculatorService->sum(0.0, 5.0);
        $this->assertEquals(5.0, $result);
    }

    public function testSumWithDecimals(): void
    {
        $result = $this->calculatorService->sum(2.5, 3.7);
        $this->assertEquals(6.2, $result);
    }

    public function testMultiplyWithPositiveNumbers(): void
    {
        $result = $this->calculatorService->multiply(2.0, 3.0);
        $this->assertEquals(6.0, $result);
    }

    public function testMultiplyWithNegativeNumbers(): void
    {
        $result = $this->calculatorService->multiply(-2.0, -3.0);
        $this->assertEquals(6.0, $result);
    }

    public function testMultiplyWithMixedNumbers(): void
    {
        $result = $this->calculatorService->multiply(-2.0, 3.0);
        $this->assertEquals(-6.0, $result);
    }

    public function testMultiplyWithZero(): void
    {
        $result = $this->calculatorService->multiply(0.0, 5.0);
        $this->assertEquals(0.0, $result);
    }

    public function testMultiplyWithDecimals(): void
    {
        $result = $this->calculatorService->multiply(2.5, 4.0);
        $this->assertEquals(10.0, $result);
    }

    public function testMultiplyWithOne(): void
    {
        $result = $this->calculatorService->multiply(7.0, 1.0);
        $this->assertEquals(7.0, $result);
    }
}
