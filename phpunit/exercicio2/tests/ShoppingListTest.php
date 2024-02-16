<?php

use PHPUnit\Framework\TestCase;

require 'src/ShoppingList.php'; 

class ShoppingListTest extends TestCase
{
    public function testAddItem()
    {
        $shoppingList = new ShoppingList();
        
        $initialCount = count($shoppingList->getitens());
        $shoppingList->addItem("leite");
        $this->assertCount($initialCount + 1, $shoppingList->getitens(), "A quantidade de itens deve aumentar após adicionar um novo item.");

        $itens = $shoppingList->getitens();
        $lastItem = end($itens);
        $this->assertEquals("leite", $lastItem, "O último item adicionado deve ser 'leite'.");
    }
    
    // Testa a adição de itens duplicados
    public function testAddItemDuplicates()
    {
        $shoppingList = new ShoppingList();

        $shoppingList->addItem("leite");
        $shoppingList->addItem("leite");
        $this->assertCount(2, $shoppingList->getitens(), "Deve ser possível adicionar itens duplicados, totalizando 2 itens iguais.");
    }

    public function testRemoveItem()
    {
        $shoppingList = new ShoppingList();

        $shoppingList->addItem("leite");
        $shoppingList->addItem("Banana");

        $shoppingList->removeItem(0); // Remove "leite"

        $this->assertNotContains("leite", $shoppingList->getitens(), "leite deve ser removida da lista.");
        $this->assertContains("Banana", $shoppingList->getitens(), "Banana deve permanecer na lista após a remoção de leite.");
    }

    // Testa a remoção de um item que não existe
    public function testRemoveNonexistentItem()
    {
        $shoppingList = new ShoppingList();

        $shoppingList->addItem("leite");
        $shoppingList->removeItem(10); // Índice que não existe

        $this->assertCount(1, $shoppingList->getitens(), "A lista deve continuar com o mesmo número de itens após tentativa de remover um índice inexistente.");
    }

    // Testa se todos os itens são removidos
    public function testClearitens()
    {
        $shoppingList = new ShoppingList();
        
        $shoppingList->addItem("leite");
        $shoppingList->addItem("Banana");
        $shoppingList->clearitens();
        $this->assertEmpty($shoppingList->getitens(), "Todos os itens devem ser removidos da lista.");
    }
}

