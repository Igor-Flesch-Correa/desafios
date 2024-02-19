<?php

use PHPUnit\Framework\TestCase;

class MyClass
{
    private TestCase $testCase;

    public function __construct(TestCase $testCase)
    {
        $this->testCase = $testCase;
    }

    public function createMock(string $className, array $options = []): object
    {
        $mockBuilder = $this->testCase->getMockBuilder($className);

        if (!empty($options['constructorArgs'])) {
            $mockBuilder->setConstructorArgs($options['constructorArgs']);
        } else {
            $mockBuilder->disableOriginalConstructor();
        }

        if (!empty($options['methods'])) {
            $mockBuilder->addMethods($options['methods']);
        }

        if (!empty($options['clone']) && !$options['clone']) {
            $mockBuilder->disableOriginalClone();
        }

        if (!empty($options['autoload']) && !$options['autoload']) {
            $mockBuilder->disableAutoload();
        }

        $mock = $mockBuilder->getMock();

        foreach ($options['methodReturns'] ?? [] as $method => $return) {
            $mock->method($method)->willReturn($return);
        }

        foreach ($options['methodSelf'] ?? [] as $method) {
            $mock->method($method)->willReturnSelf();
        }

        return $mock;
    }
}

/*
uso

use PHPUnit\Framework\TestCase;

class MyTestClass extends TestCase
{
    public function testExample()
    {
        // Instancia MyClass passando $this, que é uma instância de TestCase
        $myClassInstance = new MyClass($this);
        
        // Cria um mock para uma classe de exemplo, configurando conforme necessário
        $mock = $myClassInstance->createMock(SomeClass::class, [
            'constructorArgs' => ['arg1', 'arg2'], // Argumentos do construtor, se necessário
            'methods' => ['method1', 'method2'], // Métodos adicionais para mockar
            'methodReturns' => ['method1' => 'value1', 'method2' => 'value2'], // Configura retornos específicos
            'methodSelf' => ['method3'], // Métodos que devem retornar o próprio objeto mock
            'clone' => false, // Desabilita a clonagem do objeto
            'autoload' => false // Desabilita o autoload
        ]);

        // Agora, você pode utilizar $mock em seus testes conforme necessário
    }
}
*/