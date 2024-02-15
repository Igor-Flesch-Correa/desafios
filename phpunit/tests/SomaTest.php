<?php

use PHPUnit\Framework\TestCase;

require_once 'app/src/Soma.php';

class SomaTest extends TestCase
{
    public function testSomaDeDoisNumerosNegativos()
    {
        $Soma = new Soma();
        $this->assertEquals(-10, $Soma->somar(-4, -6), "soma -4 e -6 tem que dar -10");
    }

    public function testSomaDeNumeroPositivoComNegativo()
    {
        $Soma = new Soma();
        $this->assertEquals(1, $Soma->somar(5, -4), "soma 5 e -4 tem que dar 1");
    }

    /* este teste verifica se o método somar lida corretamente com a adição de zero a um
    número positivo, garantindo que o resultado seja o próprio número positivo. Isso é
    relevante para garantir que a classe trate adequadamente casos especiais.*/
    public function testSomaComZero()
    {
        $Soma = new Soma();
        $this->assertEquals(5, $Soma->somar(5, 0), "soma 5 e 0 tem que dar 5");
    }

    /* este teste verifica se o método somar lida corretamente com a adição de zero a um
    número negativo, garantindo que o resultado seja o próprio número negativo. Isso é
    relevante para garantir que a classe trate adequadamente casos especiais.*/
    public function testSomaNegativoComZero()
    {
        $Soma = new Soma();
        $this->assertEquals(-5, $Soma->somar(-5, 0), "soma -5 e 0 tem que dar -5");
    }
}
