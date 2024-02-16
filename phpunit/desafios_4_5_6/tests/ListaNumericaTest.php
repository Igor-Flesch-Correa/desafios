<?php

use PHPUnit\Framework\TestCase;

require_once 'src/ListaNumerica.php';

class ListaNumericaTest extends TestCase
{
    public function testAdicionarNumero()
    {
        $lista = new ListaNumerica();
        $lista->adicionarNumero(5);

        $this->assertEquals([5], $lista->retornaNumeros());
    }

    public function testAdicionarNumeroNaoNumerico()
    {
        $this->expectException(InvalidArgumentException::class);

        $lista = new ListaNumerica();
        $lista->adicionarNumero('não é um número');
    }

    public function testGetMaximo()
    {
        $lista = new ListaNumerica();
        $lista->adicionarNumero(1);
        $lista->adicionarNumero(2);
        $lista->adicionarNumero(3);

        $this->assertEquals(3, $lista->getMaximo());
    }

    public function testGetMinimo()
    {
        $lista = new ListaNumerica();
        $lista->adicionarNumero(1);
        $lista->adicionarNumero(2);
        $lista->adicionarNumero(3);

        $this->assertEquals(1, $lista->getMinimo());
    }

    public function testCalcularMedia()
    {
        $lista = new ListaNumerica();
        $lista->adicionarNumero(1);
        $lista->adicionarNumero(2);
        $lista->adicionarNumero(3);

        $this->assertEquals(2, $lista->calcularMedia());
    }

    public function testCalcularMediaListaVazia()
    {
        $lista = new ListaNumerica();

        $this->assertNull($lista->calcularMedia());
    }
}
