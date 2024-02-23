<?php

use PHPUnit\Framework\TestCase;

require_once 'src/CalculadoraFinanceira.php';//tentar fazer com autoload

/*

• Valores positivos e negativos para os parâmetros de entrada.
• Valores extremos e limites de precisão para os cálculos financeiros. ok---
• Testes para verificar a resposta correta em situações de entrada válida e
inválida.
• A cobertura de código será monitorada para garantir que todas as linhas de
código da classe CalculadoraFinanceira sejam testadas

mensagens nos assertions

*/

class CalculadoraFinanceiraTest extends TestCase {

    public function testCalcularJurosSimples() {
    
        $capital = 1000;
        $taxa = 0.05;
        $tempo = 12;

        $resultado = CalculadoraFinanceira::calcularJurosSimples($capital, $taxa, $tempo);

        $this->assertEqualsWithDelta(600.00, $resultado, 0.01, 'A diferença do resultado obtido do esperado está fora da margem permitida de diferença');
    }

    public function testCalcularJurosSimplesComCapitalNegativo() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O capital deve ser maior ou igual a zero.");
        CalculadoraFinanceira::calcularJurosSimples(-100, 0.05, 12);
    }

    public function testCalcularJurosSimplesComTempoMenorQueZero() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O tempo deve ser maior ou igual a zero.");
        CalculadoraFinanceira::calcularJurosSimples(1000, 0.05, -1);
    }


    public function testCalcularJurosCompostos() {
       
        $capital = 1000;
        $taxa = 0.05;
        $tempo = 12;

        $resultado = CalculadoraFinanceira::calcularJurosCompostos($capital, $taxa, $tempo);

        $this->assertEqualsWithDelta(795.86, $resultado, 0.01, 'A diferença do resultado obtido do esperado está fora da margem permitida de diferença');
    }

    public function testCalcularJurosCompostosComCapitalNegativo() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O capital deve ser maior ou igual a zero.");
        CalculadoraFinanceira::calcularJurosCompostos(-100, 0.05, 12);
    }

    public function testCalcularJurosCompostosComTempoMenorQueZero() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O tempo deve ser maior ou igual a zero.");
        CalculadoraFinanceira::calcularJurosCompostos(1000, 0.05, -1);
    }

    public function testCalcularAmortizacaoSAC() {
        
        $capital = 1000;
        $taxa = 0.05;
        $tempo = 4;
        $tipo = 'SAC';
        $esperado = [
            'periodo1' => 300.0,
            'periodo2' => 287.5,
            'periodo3' => 275.0,
            'periodo4' => 262.5,
            'jurosTotal' => 125 
        ];
    
        $resultado = CalculadoraFinanceira::calcularAmortizacao($capital, $taxa, $tempo, $tipo);
    
        foreach ($esperado as $chave => $valorEsperado) {
            $this->assertEqualsWithDelta($valorEsperado, $resultado[$chave], 0.01, 'valores fora da margem de erro esperada');
        }
    }
    
    public function testCalcularAmortizacaoPrice() {
        
        // Arrange
        $capital = 1000;
        $taxa = 0.05;
        $tempo = 4;
        $tipo = 'Price';
        $esperado = [
            'periodo1' => 282.01,
            'periodo2' => 282.01,
            'periodo3' => 282.01,
            'periodo4' => 282.01,
            'jurosTotal' => 128.05 
        ];
    
        $resultado = CalculadoraFinanceira::calcularAmortizacao($capital, $taxa, $tempo, $tipo);
    
        foreach ($esperado as $chave => $valorEsperado) {
            $this->assertEqualsWithDelta($valorEsperado, $resultado[$chave], 0.01, 'valores fora da margem de erro esperada');
        }
    }

    public function testAmortizacaoComCapitalInvalido() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O capital deve ser maior ou igual a zero.");
        CalculadoraFinanceira::calcularAmortizacao(-10, 0.05, 12, 'SAC');
    }

    public function testAmortizacaoComTempoInvalido() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O tempo deve ser maior ou igual a zero.");
        CalculadoraFinanceira::calcularAmortizacao(1000, 0.05, -1, 'SAC');
    }

    public function testAmortizacaoComTipoInvalido() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("O tipo deve ser 'SAC' ou 'Price'.");
        CalculadoraFinanceira::calcularAmortizacao(1000, 0.05, 12, 'Invalido');
    }

}

