<?php

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

require_once 'src/MinhaClasseAvancado.php';



class MinhaClasseAvancadoTest extends TestCase
{
    public function testSomaCorreta()
    {
        $this->assertEquals(4, MinhaClasseAvancado::somar(2, 2));
    }

    public function testSomaComZero()
    {
        $this->assertEquals(0, MinhaClasseAvancado::somar(0, 0));
        $this->assertEquals(5, MinhaClasseAvancado::somar(5, 0));
        $this->assertEquals(5, MinhaClasseAvancado::somar(0, 5));
    }

    public function testSomaComDecimais()
    {
        $this->assertEquals(7.5, MinhaClasseAvancado::somar(5, 2.5));
        $this->assertEquals(10.75, MinhaClasseAvancado::somar(5.25, 5.5));
    }
    
    public function testSomaComArgumentosInvalidos()
    {
        $this->expectException(InvalidArgumentException::class);
        MinhaClasseAvancado::somar('a', 5);
    }

    public function testSubtrair()
    {
        $this->assertEquals(5, MinhaClasseAvancado::subtrair(10, 5));
        $this->assertEquals(0, MinhaClasseAvancado::subtrair(5, 5));
        $this->assertEquals(-5, MinhaClasseAvancado::subtrair(5, 10));

        $this->assertEquals(2.5, MinhaClasseAvancado::subtrair(5, 2.5));
        $this->assertEquals(-0.25, MinhaClasseAvancado::subtrair(5.25, 5.5));

        $this->assertEquals(0, MinhaClasseAvancado::subtrair(0, 0));
        $this->assertEquals(5, MinhaClasseAvancado::subtrair(5, 0));
        $this->assertEquals(-5, MinhaClasseAvancado::subtrair(0, 5));
    }

   

    public function testSubtrairComArgumentosInvalidos()
    {
        $this->expectException(InvalidArgumentException::class);
        MinhaClasseAvancado::subtrair(10, 'b');
    }
}
