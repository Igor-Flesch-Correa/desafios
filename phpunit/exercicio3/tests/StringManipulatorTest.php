<?php

use PHPUnit\Framework\TestCase;

require 'src/StringManipulator.php';

class StringManipulatorTest extends TestCase
{
    public function testCapitalizeStringWithEmptyString()
    {
        $sm = new StringManipulator();
        $this->assertEquals('', $sm->capitalizeString(''), "A string vazia deve permanecer inalterada.");
    }

    public function testConcatenateStringsWithSpaces()
    {
        $sm = new StringManipulator();
        $result1 = $sm->concatenateStrings('Hello ', 'World');
        $result = $sm->concatenateStrings("{$result1}", ' miau, a good day to you');//espaço no inicio do segundo argumento
        $this->assertEquals('Hello World miau, a good day to you', $result, "As strings devem ser concatenadas corretamente, mantendo os espaços.");
    }

    public function testCountVowels()
    {
        $sm = new StringManipulator();
        // Teste com vogais minúsculas
        $this->assertEquals(5, $sm->countVowels('aeiou'), "Deve contar 5 vogais em 'aeiou'.");
        // Teste com vogais maiúsculas
        $this->assertEquals(5, $sm->countVowels('AEIOU'), "Deve contar 5 vogais em 'AEIOU'.");
        // Teste com uma mistura de vogais e consoantes
        $this->assertEquals(3, $sm->countVowels('HEllo WOrld'), "Deve contar 3 vogais em 'HEllo WOrld'.");
        // Teste sem vogais
        $this->assertEquals(0, $sm->countVowels('bcdfg'), "Deve contar 0 vogais em 'bcdfg'.");
        // Teste vazia
        $this->assertEquals(0, $sm->countVowels(''), "Deve contar 0 vogais em ''.");
    }
}
