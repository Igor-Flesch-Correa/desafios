<?php

use PHPUnit\Framework\TestCase;

require_once 'src/ListaNumerica.php';

class ListaNumericaTest extends TestCase
{
    public function testSomarElementos()
    {
        $this->assertEquals(-15, ListaNumerica::somarElementos([-1, -2, -3, -4, -5]));
        $this->assertEquals(-10, ListaNumerica::somarElementos([5, -15]));
        $this->assertEquals(15, ListaNumerica::somarElementos([1, 2, 3, 4, 5]));
        $this->assertEquals(0, ListaNumerica::somarElementos([]));
    }

    public function testEncontrarMaiorElemento()
    {
        $this->assertEquals(-1, ListaNumerica::encontrarMaiorElemento([-5, -4, -3, -2, -1]));
        $this->assertEquals(5, ListaNumerica::encontrarMaiorElemento([-5, 0, 5]));
        $this->assertEquals(5, ListaNumerica::encontrarMaiorElemento([1, 2, 3, 4, 5]));
        $this->assertNull(ListaNumerica::encontrarMaiorElemento([]));
    }

    public function testEncontrarMenorElemento()
    {
        $this->assertEquals(-5, ListaNumerica::encontrarMenorElemento([-1, -2, -3, -4, -5]));
        $this->assertEquals(-5, ListaNumerica::encontrarMenorElemento([-5, 0, 5]));
        $this->assertEquals(1, ListaNumerica::encontrarMenorElemento([1, 2, 3, 4, 5]));
        $this->assertNull(ListaNumerica::encontrarMenorElemento([]));
    }

    public function testOrdenarLista()
    {
        $this->assertEquals([-5, -4, -3, -2, -1], ListaNumerica::ordenarLista([-1, -3, -5, -2, -4]));
        $this->assertEquals([-5, 0, 5], ListaNumerica::ordenarLista([5, -5, 0]));
        $this->assertEquals([1, 2, 3, 4, 5], ListaNumerica::ordenarLista([5, 3, 1, 4, 2]));
        $this->assertEquals([], ListaNumerica::ordenarLista([]));
    }

    public function testFiltrarNumerosPares()
    {
        $this->assertEquals([2, -4], ListaNumerica::filtrarNumerosPares([-1, 2, -3, -4, 5]));
        $this->assertEquals([2, 4], ListaNumerica::filtrarNumerosPares([1, 2, 3, 4, 5]));
        $this->assertEquals([], ListaNumerica::filtrarNumerosPares([1, 3, 5]));
    }
}

