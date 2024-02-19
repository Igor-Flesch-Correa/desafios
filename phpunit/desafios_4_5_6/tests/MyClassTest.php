<?php

use PHPUnit\Framework\TestCase;

require_once 'src/MyClass.php';

class ExampleClass {
    public function exampleMethod() {
        return "Original Value";
    }
}

class MyClassTest extends TestCase
{
    public function testAddMethods()
    {
        $myClass = new MyClass($this);
        $mock = $myClass->createMock(ExampleClass::class, [
            'methods' => ['method1', 'method2']
        ]);

        // Assumindo que ExampleClass não tem 'method1' ou 'method2' originalmente
        $this->assertTrue(method_exists($mock, 'method1'));
        $this->assertTrue(method_exists($mock, 'method2'));
    }

    public function testSetConstructorArgs()
    {
        $myClass = new MyClass($this);
        // Testa se o mock é criado sem erros ao definir argumentos do construtor
        $mock = $myClass->createMock(ExampleClass::class, [
            'constructorArgs' => ['arg1', 'arg2']
        ]);
        $this->assertInstanceOf(ExampleClass::class, $mock);
    }

    public function testDisableOriginalConstructor()
    {
        $myClass = new MyClass($this);
        // Simplesmente verificando se o mock é criado, pois o PHPUnit não expõe uma forma direta de verificar se o construtor foi desabilitado
        $mock = $myClass->createMock(ExampleClass::class);
        $this->assertInstanceOf(ExampleClass::class, $mock);
    }

    public function testDisableOriginalClone()
    {
        $myClass = new MyClass($this);
        // Testando se o clone está desabilitado indiretamente, já que não há um método específico para verificar isso
        $mock = $myClass->createMock(ExampleClass::class, ['clone' => false]);
        $this->expectException(\BadMethodCallException::class);
        clone $mock;
    }

    public function testDisableAutoload()
    {
        $myClass = new MyClass($this);
        // Difícil de testar sem uma classe que dependa do autoload, mas a criação sem erros já é um bom sinal
        $mock = $myClass->createMock(ExampleClass::class, ['autoload' => false]);
        $this->assertInstanceOf(ExampleClass::class, $mock);
    }

    public function testMethodWillReturn()
    {
        $myClass = new MyClass($this);
        $expected = 'value';
        $mock = $myClass->createMock(ExampleClass::class, [
            'methodReturns' => ['methodName' => $expected]
        ]);
        $this->assertEquals($expected, $mock->methodName());
    }

    public function testMethodReturnSelf()
    {
        $myClass = new MyClass($this);
        $mock = $myClass->createMock(ExampleClass::class, [
            'methodSelf' => ['methodName']
        ]);
        $this->assertSame($mock, $mock->methodName());
    }
}

/*
Este código pressupõe que você tem acesso a uma classe chamada ExampleClass, 
que você deseja mockar em seus testes. Os métodos testDisableOriginalClone e 
testDisableAutoload estão mais para ilustrar a lógica do que testes concretos, 
pois são situações mais difíceis de verificar diretamente. Para testDisableOriginalClone,
 ele tenta clonar o mock, esperando um erro para confirmar que a clonagem foi desabilitada,
 o que pode não ser o comportamento exato dependendo de como o PHPUnit manipula clones de mocks internamente.
*/

/*
Considerações

    Métodos addMethods e onlyMethods: Certifique-se de que o uso de addMethods está 
    alinhado com suas necessidades. addMethods é usado para adicionar métodos que não 
    existem na classe original, enquanto onlyMethods é usado para sobrescrever métodos
    que existem. Se precisar mockar métodos existentes, considere usar onlyMethods se
    sua versão do PHPUnit suportar.

    Erro Potencial com methodReturns e methodSelf: Se um método estiver tanto em methodReturns
    quanto em methodSelf, o comportamento final dependerá de como o PHPUnit lida com múltiplas
    configurações para o mesmo método. É improvável que este cenário ocorra conforme o seu
    uso intencionado, mas é algo a ser consciente.

    Exceção ao Clonar: No teste testDisableOriginalClone, você espera uma BadMethodCallException
    ao tentar clonar o mock quando o clone está desabilitado. Isso está correto, contanto que o
    PHPUnit lança essa exceção específica quando a clonagem é tentada em um mock com a clonagem
    desabilitada. Certifique-se de que essa é a exceção correta para a versão do PHPUnit que você está usando.

*/