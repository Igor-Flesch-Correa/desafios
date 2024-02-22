<?php

use PHPUnit\Framework\TestCase;

require_once 'src/CalculadoraFinanceira.php';//tentar fazer com autoload

class CalculadoraFinanceiraTest extends TestCase {
    private $calculadora;

    protected function setUp(): void {
        $this->calculadora = new CalculadoraFinanceira();
    }

    public function testCalcularJurosSimples() {
        $resultado = $this->calculadora->calcularJurosSimples(1000, 0.05, 2);
        $this->assertEquals(100, $resultado);
    }

    public function testCalcularJurosCompostos() {
        $resultado = $this->calculadora->calcularJurosCompostos(1000, 0.05, 2);
        $this->assertEqualsWithDelta(102.5, $resultado, 0.01);
    }

    public function testCalcularAmortizacaoSAC() {
        $resultado = $this->calculadora->calcularAmortizacao(1000, 0.1, 2, 'SAC');
        $this->assertCount(2, $resultado);
        $this->assertArrayHasKey('amortizacao', $resultado[0]);
        $this->assertArrayHasKey('juros', $resultado[0]);
    }

    public function testCalcularAmortizacaoPrice() {
        $resultado = $this->calculadora->calcularAmortizacao(1000, 0.1, 2, 'Price');
        $this->assertCount(2, $resultado);
        foreach ($resultado as $parcela) {
            $this->assertArrayHasKey('parcela', $parcela);
        }
    }

    // Aqui, você pode adicionar mais métodos de teste conforme necessário.
}
