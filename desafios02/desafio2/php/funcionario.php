<?php

require_once 'Conexao.php'; // Ajuste o caminho conforme necessário

class Funcionario
{
    private $id;
    private $nome;
    private $genero;
    private $idade;
    private $salario;

    public function __construct($nome = '', $genero = '', $idade = 0, $salario = 0.0, $id = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->genero = $genero;
        $this->idade = $idade;
        $this->salario = $salario;
    }

    // Getters e setters aqui...

    public function cadastrar()
    {
        $conexao = (new Conexao())->conectar();
        $sql = "INSERT INTO public.funcionarios (nome, genero, idade, salario) VALUES (:nome, :genero, :idade, :salario)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':genero', $this->genero);
        $stmt->bindValue(':idade', $this->idade);
        $stmt->bindValue(':salario', $this->salario);
        return $stmt->execute();
    }

   

    public function atualizar()
    {
        $conexao = (new Conexao())->conectar();
        $sql = "UPDATE public.funcionarios SET nome = :nome, genero = :genero, idade = :idade, salario = :salario WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':genero', $this->genero);
        $stmt->bindValue(':idade', $this->idade);
        $stmt->bindValue(':salario', $this->salario);
        return $stmt->execute();
    }

    public function excluir()
    {
        $conexao = (new Conexao())->conectar();
        $sql = "DELETE FROM public.funcionarios WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        return $stmt->execute();
    }

     public function listarTodos()
    {
        $conexao = (new Conexao())->conectar();
        $sql = "SELECT * FROM public.funcionarios";
        $stmt = $conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorId($id)
    {
        $conexao = (new Conexao())->conectar();
        $sql = "SELECT * FROM public.funcionarios WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function aumentarSalario($percentual)
    {
        $this->salario += ($this->salario * $percentual) / 100;
        $this->atualizar();
    }
}

?>
