<?php

use PHPUnit\Framework\TestCase;

require_once 'src/MyClass.php';

class ExampleClass {
    private $arg1;
    private $arg2;

    public function __construct($arg1 = null, $arg2 = null) {
        $this->arg1 = $arg1;
        $this->arg2 = $arg2;
    }

    public function methodName() {
        return "algum valor";
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

        $this->assertTrue(method_exists($mock, 'method1'));
        $this->assertTrue(method_exists($mock, 'method2'));
    }

    public function testSetConstructorArgs()
    {
        $myClass = new MyClass($this);
        $mock = $myClass->createMock(ExampleClass::class, [
            'constructorArgs' => ['arg1', 'arg2']
        ]);
        $this->assertInstanceOf(ExampleClass::class, $mock);
    }
   

    public function testDisableOriginalConstructor()
    {
        $myClass = new MyClass($this);
        $mock = $myClass->createMock(ExampleClass::class);
        $this->assertInstanceOf(ExampleClass::class, $mock);
    }


    public function testDisableOriginalClone()
    {
        $myClass = new MyClass($this);
        
        
        $mockWithCloningEnabled = $myClass->createMock(ExampleClass::class);
        try {
            $clonedObject = clone $mockWithCloningEnabled;
            $cloneSuccess = true; 
        } catch (Exception $e) {
            $cloneSuccess = false; 
        }
        $this->assertTrue($cloneSuccess, 'A clonagem deve ser bem-sucedida com as configurações padrão');
        
       
        $mockWithCloningDisabled = $myClass->createMock(ExampleClass::class, ['clone' => false]); 
        try {
            $clonedObject2 = clone $mockWithCloningDisabled; 
            $cloneFailed = false; 
        } catch (Exception $e) {
            $cloneFailed = true; 
        }
        $this->assertTrue($cloneFailed, 'A clonagem deve falhar quando desabilitada');
    }

 
    public function testDisableAutoload()
    {
        $myClass = new MyClass($this);
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

